<div class="md:grid grid-cols-12 gap-2">
    <x-input id="father-full-name" name="father_full_name" label="Father's Full Name" placeholder="Father's full name" group-class="col-span-6" />
    <x-input id="father-phone-number" name="father_phone_number" label="Father's Phone Number" placeholder="Father's phone number" group-class="col-span-6" />
    <x-input id="father-address" name="father_address" label="Father's Address" placeholder="Father's address" group-class="col-span-12" />
    <x-input id="mother-full-name" name="mother_full_name" label="Mother's Full Name" placeholder="Mother's full name" group-class="col-span-6" />
    <x-input id="mother-phone-number" name="mother_phone_number" label="Mother's Phone Number" placeholder="Mother's phone number" group-class="col-span-6" />
    <x-input id="mother-address" name="mother_address" label="Mother's Address" placeholder="Mother's address" group-class="col-span-12" />
    <x-input id="emergency-contact-name" name="emergency_contact_name" label="Emergency Contact Name" placeholder="Emergency contact's full name" group-class="col-span-6" />
    <x-input id="emergency-contact-relationship" name="emergency_contact_relationship" label="Relationship to Student" placeholder="e.g. Aunt, Uncle, Grandparent" group-class="col-span-6" />
    <x-input id="emergency-contact-number" name="emergency_contact_number" label="Emergency Contact Number" placeholder="Emergency contact's phone number" group-class="col-span-6" />
    <x-input id="emergency-contact-address" name="emergency_contact_address" label="Emergency Contact Address" placeholder="Emergency contact's address" group-class="col-span-6" />
    
    <x-select id="class-id" name="my_class_id" label="Choose a class *" group-class="col-span-6" wire:model.live="myClass">
        @foreach ($myClasses as $item)
            <option value="{{$item['id']}}">{{$item['name']}}</option>
        @endforeach
    </x-select>
    <x-select id="class-id" name="section_id" label="Choose a section *" group-class="col-span-6" wire:model.live="section">
        @if (isset($sections))
            @foreach ($sections as $item)
                <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        @else
            <option value="" disabled>Select a class first</option>
        @endif
    </x-select>
    <x-input id="admission-number" name="admission_number" label="Admission number" placeholder="Student's admission number" group-class="col-span-6" />
    <x-input type="date" id="admission-date" name="admission_date" placeholder="Choose student's admission date..." label="Date of admission  *"  group-class="col-span-6" value="{{old('admission_date')}}"  autocomplete="off" wire:ignore />
</div>