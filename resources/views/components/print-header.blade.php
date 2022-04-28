@props(['config' => null])
<div {{ $attributes->merge(['class' => 'mb-8 border-b-4 border-primary pb-4'])}}>
    @if ($config !== null)
    <div class="flex items-start ">
        <div>
            <img src="{{asset('images/sogojayalogo.png')}}" alt="logo" class="mb-4 w-64">
        </div>
        <div class="text-center grow">
            <h1 class="font-bold text-2xl">SOGO JAYA AC</h1>
            <div>{{$config->alamat}}</div>
            <div class="text-sm font-semibold flex justify-center gap-4">
                <div>Telp: {{$config->no_telp}}</div>
                <div>HP: {{$config->hp_1}} / {{$config->hp_2}}</div>
            </div>
        </div>
    </div>
    @else
    <div class="flex items-start ">
        <div>
            <img src="{{asset('images/sogojayalogo.png')}}" alt="logo" class="mb-4 w-64">
        </div>
        <div class="text-center grow">
            <h1 class="font-bold text-2xl">SOGO JAYA AC</h1>
            <div>Office: Jl. Teuku Umar, No. 18 Cimone, Tangerang</div>
            <div class="text-sm font-semibold flex justify-center gap-4">
                <div>Telp: 021-55790472</div>
                <div>HP: 0877 8807 36666 / 08738959 9265</div>
            </div>
        </div>
    </div>
    @endif
</div>