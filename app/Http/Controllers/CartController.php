<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartConfirmationFormRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Screening;

class CartController extends Controller
{
    public function show(): View
    {
        $cart = session('cart', null);
        return view('cart.show', compact('cart'));
    }

    public function addToCart(Request $request, Ticket $ticket): RedirectResponse
    {
        $selectedSeats = $request->input('seats', []);
        
        $screening = Screening::find($request->input('screening_id'));
        
        $cart = session('cart', collect());
        
        $trueSeats = [];

        foreach ($selectedSeats as $seatId => $value) {
            if (filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
                $trueSeats[] = $seatId;
            }
        }

        foreach ($trueSeats as $seatId) {
            if ($cart->contains($seatId)) {
                $alertType = 'warning';
                $url = route('home');
                $htmlMessage = "Seat <a href='$url'>#{$seatId}</a> <strong>\"{$seatId}\"</strong> was not added to the cart because it is already there!";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $cart->push($seatId);
            }
         }

    $request->session()->put('cart', $cart);

    $alertType = 'success';
    $htmlMessage = "Os assentos selecionados foram adicionados ao carrinho.";
    return back()
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, Discipline $discipline): RedirectResponse
    {
        $url = route('disciplines.show', ['discipline' => $discipline]);
        $cart = session('cart', null);
        if (!$cart) {
            $alertType = 'warning';
            $htmlMessage = "Discipline <a href='$url'>#{$discipline->id}</a>
                <strong>\"{$discipline->name}\"</strong> was not removed from the cart because cart is empty!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        } else {
            $element = $cart->firstWhere('id', $discipline->id);
            if ($element) {
                $cart->forget($cart->search($element));
                if ($cart->count() == 0) {
                    $request->session()->forget('cart');
                }
                $alertType = 'success';
                $htmlMessage = "Discipline <a href='$url'>#{$discipline->id}</a>
                <strong>\"{$discipline->name}\"</strong> was removed from the cart.";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $alertType = 'warning';
                $htmlMessage = "Discipline <a href='$url'>#{$discipline->id}</a>
                <strong>\"{$discipline->name}\"</strong> was not removed from the cart because cart does not include it!";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');
    }


    public function confirm(CartConfirmationFormRequest $request): RedirectResponse
    {
        $cart = session('cart', null);
        if (!$cart || ($cart->count() == 0)) {
            return back()
                ->with('alert-type', 'danger')
                ->with('alert-msg', "Cart was not confirmed, because cart is empty!");
        } else {
            $student = Student::where('number', $request->validated()['student_number'])->first();
            if (!$student) {
                return back()
                    ->with('alert-type', 'danger')
                    ->with('alert-msg', "Student number does not exist on the database!");
            }
            $insertDisciplines = [];
            $disciplinesOfStudent = $student->disciplines;
            $ignored = 0;
            foreach ($cart as $discipline) {
                $exist = $disciplinesOfStudent->where('id', $discipline->id)->count();
                if ($exist) {
                    $ignored++;
                } else {
                    $insertDisciplines[$discipline->id] = [
                        "discipline_id" => $discipline->id,
                        "repeating" => 0,
                        "grade" => null,
                    ];
                }
            }
            $ignoredStr = match($ignored) {
                0 => "",
                1 => "<br>(1 discipline was ignored because student was already enrolled in it)",
                default => "<br>($ignored disciplines were ignored because student was already enrolled on them)"
            };
            $totalInserted = count($insertDisciplines);
            $totalInsertedStr = match($totalInserted) {
                0 => "",
                1 => "1 discipline registration was added to the student",
                default => "$totalInserted disciplines registrations were added to the student",

            };
            if ($totalInserted == 0) {
                $request->session()->forget('cart');
                return back()
                    ->with('alert-type', 'danger')
                    ->with('alert-msg', "No registration was added to the student!$ignoredStr");
            } else {
                DB::transaction(function () use ($student, $insertDisciplines) {
                    $student->disciplines()->attach($insertDisciplines);
                });
                $request->session()->forget('cart');
                if ($ignored == 0) {
                    return redirect()->route('students.show', ['student' => $student])
                        ->with('alert-type', 'success')
                        ->with('alert-msg', "$totalInsertedStr.");
                } else {
                    return redirect()->route('students.show', ['student' => $student])
                        ->with('alert-type', 'warning')
                        ->with('alert-msg', "$totalInsertedStr. $ignoredStr");
                }
            }
        }
    }
}
