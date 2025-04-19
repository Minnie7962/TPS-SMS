<div>
    @hasanyrole('admin|super-admin')
    <div class="card">
        <div class="card-body">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @can('read student')
                    <x-info-box title="{{$students}}" text="Students (active)" icon=" text-dark" theme="yellow" url="{{route('students.index')}}" url-text="View students" colour="bg-blue-600"  text-colour="text-white"/>
                @endcan
                @can('read section')
                    <x-info-box title="{{$sections}}" text="Sections" url="{{route('sections.index')}}" url-text="View sections" colour="bg-indigo-700" text-colour="text-white" />
                @endcan
                @can('read class')
                    <x-info-box title="{{$classes}}" text="Classes" url="{{route('classes.index')}}" url-text="View classes" colour="bg-violet-700"  text-colour="text-white"/>
                @endcan
            </div>
        </div>
    </div>
    @endhasanyrole
</div>

