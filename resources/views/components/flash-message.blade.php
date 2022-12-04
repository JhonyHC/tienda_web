@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="fixed top-0 mt-3 left-1/2 transform-translate-x-1/2 bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
    <p class="font-bold">{{session('message')}}</p>
    {{-- <p class="text-sm">El producto fue creado sin problemas.</p> --}}
  </div>
@endif