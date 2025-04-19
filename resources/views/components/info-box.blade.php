<div class="{{$class}} {{$colour}} {{$textColour}} shadow-lg rounded-lg">
    <div class="p-4 md:p-6 text-center md:text-left md:flex gap-6 items-center justify-between border-b">
        <div>
            <h3 class="text-5xl md:text-6xl my-4 font-bold">{{$title}}</h3>
            <p class="text-2xl my-4">{{$text}}</p>
        </div>
        <i class="{{$icon}} m-5 text-center text-8xl hidden md:block" aria-hidden="true"></i>
    </div>
    @isset ($url)
        <div class="w-full bg-black bg-opacity-30 flex items-center justify-center">
            <a href="{{$url}}" class="w-full py-3 md:py-4 text-center text-lg">{{$urlText ?? 'View'}} <i class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></a>
        </div>
    @endif
</div>