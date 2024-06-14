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
use App\Models\Seat;
use App\Models\Configuration;

class CartController extends Controller
{
    public function show(): View
    {
        $configuration = Configuration::all();

        $cart = session('cart', null);
        return view('cart.show')
            ->with('cart',$cart)
            ->with('configuration',$configuration);
    }

    public function addToCart(Request $request): RedirectResponse
    {

    $screening = Screening::find($request->input('screening_id'));

    if (!$screening) {
        return back()->with('alert-msg', 'Screening not found')->with('alert-type', 'error');
    }

    $selectedSeats = $request->input('seats', []);
    foreach ($selectedSeats as $seatId => $value) {
        $seat = Seat::find($seatId);
        if ($seat && filter_var($value, FILTER_VALIDATE_BOOLEAN)) {

            $cartItem = collect([
                'seat' => $seat,
                'screening' => $screening
            ]);

            $cart = session('cart', collect());
            $cart->push('cartItem',$cartItem);
            $request->session()->put('cart', $cart);
        }
    }

    $alertType = 'success';
    $htmlMessage = "Os assentos selecionados foram adicionados com sucesso.";
    return back()
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, Screening $screening, Seat $seat): RedirectResponse
    {
        $cart = session('cart', null);
        if (!$cart) {
            $alertType = 'warning';
            $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> não foi removido do carrinho pois o carrinho está vazio!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        } else {
            $element = $cart->where('seat.id', $seat->id)
                            ->where('screening.id', $screening->id)
                            ->first();
            if ($element) {
                $cart->forget($cart->search($element));
                if ($cart->count() == 0) {
                    $request->session()->forget('cart');
                }
                $alertType = 'success';
                $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> foi removido do carrinho.";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $alertType = 'warning';
                $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> não foi removido pois o carrinho não possuia este assento";
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
