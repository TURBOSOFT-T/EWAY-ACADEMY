<div>
    @include('components.alert')

    <form wire:submit="update_user">
        <div class="mb-3">

            <label class="form-label" for="RePassword">{!! \App\Helpers\TranslationHelper::TranslateText('Ancien mot de passe') !!}</label>
            <input type="password" value=" {{ Auth::user()->old_password }}"placeholder="{!! \App\Helpers\TranslationHelper::TranslateText('8 - 15 caractères') !!}"
                wire:model="old_password" class= "form-control" style="font-size: 18px; color:black">
            @error('old_password')
                <span class="text-danger small"> {{ $message }} </span>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label class="form-label" for="RePassword">{!! \App\Helpers\TranslationHelper::TranslateText('Nouveau mot de passe') !!}</label>
            <input type="password" placeholder="{!! \App\Helpers\TranslationHelper::TranslateText('8 - 15 caractères') !!}" wire:model="password" class= "form-control"
                style="font-size: 18px; color:black">
            @error('password')
                <span class="text-danger small"> {{ $message }} </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="RePassword">{!! \App\Helpers\TranslationHelper::TranslateText(' Confirmation') !!}</label>
            <input type="password" placeholder="8 - 15 Caractères" wire:model="password_confirmation"
                class= "form-control" style="font-size: 18px; color:black">
            @error('password_confirmation')
                <span class="text-danger small"> {{ $message }} </span>
            @enderror
        </div>
       <div class="comment-one__btn-box">
            <button  class="btn-default disabled"   type="submit">

                
              {{--  {!! \App\Helpers\TranslationHelper::TranslateText(' Confirmer les modifications') !!} --}}
              {{ strtolower(\App\Helpers\TranslationHelper::TranslateText('Confirmer les changements')) }}

            </button>
        </div>
       
    </form>
</div>
