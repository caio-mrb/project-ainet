<div x-data="{ isToggled: false, isFree: {{json_encode($seatInfo['isFree'])}} }" class="w-min h-min">
    <input class="sr-only" name="{{$seatInfo['seat']}}" x-bind:value="isToggled">
    <div @click="isToggled = !isToggled" class="w-20">
        <svg 
        :class="isFree ? 'cursor-pointer' : ''"
        class="w-auto"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" 
        viewBox="4 2 16 20">
            <path :class="isFree ? (isToggled ? 'fill-rose-400' : 'fill-lime-500') : 'text-gray-500'" class="transition-colors duration-100" id="secondary" d="M6,17V6a4,4,0,0,1,4-4h4a4,4,0,0,1,4,4V17Zm12,4V18a1,1,0,0,0-2,0v3a1,1,0,0,0,2,0ZM8,21V18a1,1,0,0,0-2,0v3a1,1,0,0,0,2,0Z"/>
            <path :class="isFree ? (isToggled ? 'fill-rose-600' : 'fill-lime-600') : 'text-gray-700'" class="transition-colors duration-100" id="primary" d="M4,17a2,2,0,0,0,2,2H18a2,2,0,0,0,2-2V11a2,2,0,0,0-2-2h0a2,2,0,0,0-2,2v4H8V11A2,2,0,0,0,6,9H6a2,2,0,0,0-2,2Z"/>
        </svg>
    </div>
</div>

