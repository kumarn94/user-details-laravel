
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Other Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's other information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.updateotherinfo') }}" class="mt-6 space-y-6"  enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)"  autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)"  autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

         <div>
            <x-input-label for="phone_no" :value="__('Phone No')" />
            <x-text-input id="phone_no" name="phone_no" type="text" class="mt-1 block w-full" :value="old('phone_no', $user->phone_no)"  autofocus autocomplete="phone_no" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_no')" />
        </div>



        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <x-text-input id="gender" name="gender" type="radio" class="mt-1 block" :value="old('gender', 'Female')"  autocomplete="gender" /><x-input-label for="gender" :value="__('Female')" />
            <x-text-input id="gender" name="gender" type="radio" class="mt-1 block" :value="old('gender', 'Male')"  autocomplete="gender" />
            <x-input-label for="gender" :value="__('Male')" />
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="qualification" :value="__('Qualification')" />
            <x-text-input id="qualification" name="qualification" type="checkbox" class="mt-1 block" :value="old('qualification', 'School')"  autocomplete="qualification" /><x-input-label for="qualification" :value="__('School')" />
            <x-text-input id="qualification" name="qualification" type="checkbox" class="mt-1 block" :value="old('qualification', 
            'Graduation')"  autocomplete="qualification" />
            <x-input-label for="qualification" :value="__('Graduation')" />
             <x-text-input id="qualification" name="qualification" type="checkbox" class="mt-1 block" :value="old('qualification', 'Post Graduation')"  autocomplete="qualification" />
            <x-input-label for="qualification" :value="__('Post Graduation')" />
            <x-input-error class="mt-2" :messages="$errors->get('qualification')" />
        </div>

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />

                @if($user->avatar)
                <img src="{{ $user->avatar != null ? asset('avatars/' . $user->avatar) : null }}" style="width:100px; height:auto;" />
                @endif
                
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', '')"  autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-info-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
