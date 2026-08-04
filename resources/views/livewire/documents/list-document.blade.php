<div>

    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control btn-sm" wire:model="key" placeholder="Topic">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @include('components.alert')

    <div class="table-responsive-sm">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead class="table-dark cusor">
                <tr>


                    <th>Topic</th>

                    <th>Type</th>

                    <th>Nom</th>

                    <th>Document</th>
                    <th> Date création</th>
                    <th style="text-align: right;">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20" class="rounded shadow" alt="">
                        </span>
                    </th>
                </tr>
            </thead>


            <tbody>
                @forelse ($documents as $cat)
                <tr>

                    <td>


                        {{ $cat->titre }}
                    </td>

                    <td>
                        @if ($cat->event_id)
                        Événement
                        @elseif ($cat->formation_id)
                        Formation
                        @elseif ($cat->certification_id)
                        Certification
                        @else
                        —
                        @endif
                    </td>

                    <td>
                        @if ($cat->event_id && $cat->events)
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Type') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText('Evènement') }}<br>
                        <strong>Nom :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText($cat->events->titre) }}
                        @elseif ($cat->formation_id && $cat->formations)
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Type') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText('Formation') }}<br>
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Nom') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText($cat->formations->titre) }}
                        @elseif ($cat->certification_id && $cat->certifications)
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Type') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText('Certification') }}<br>
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Nom') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText($cat->certifications->titre) }}
                        @else
                        <strong>{{ \App\Helpers\TranslationHelper::TranslateText('Type') }} :</strong>
                        {{ \App\Helpers\TranslationHelper::TranslateText('Non défini') }}
                        @endif
                    </td>










                    <td>


                        @if ($cat->file)
                        <a href="{{ asset('storage/' . $cat->file) }}" target="_blank" class="custom-download-link">
                            📄 Télécharger le fichier
                        </a>
                        @endif

                    </td>

                    <style>
                        .custom-download-link {
                            display: inline-block;
                            background-color: #3490dc;
                            color: white;
                            padding: 10px 16px;
                            border-radius: 8px;
                            text-decoration: none;
                            font-weight: bold;
                            transition: background-color 0.3s ease;
                        }

                        .custom-download-link:hover {
                            background-color: #2779bd;
                        }

                    </style>

                    <td>{{ $cat->created_at->format('d/m/Y') }} </td>
                    <td style="text-align: right;">
                        <div class="btn-group">


                            @can('category_delete')
                            <button class="btn btn-sm btn-danger" onclick="toggle_confirmation({{ $cat->id }})">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                            @endcan
                        </div>


                        <button class="btn btn-sm btn-success d-none" type="button" id="confirmBtn{{ $cat->id }}" wire:click="delete({{ $cat->id }})">
                            <i class="bi bi-check-circle"></i>
                            <span class="hide-tablete">
                                Confirmer
                            </span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">
                        <div>
                            <img src="/icons/icons8-ticket-100.png" height="100" width="100" alt="" srcset="">
                        </div>
                        Aucun ducument trouvé
                    </td>
                </tr>
                @endforelse

            </tbody>


        </table>
    </div>
    {{ $documents->links('pagination::bootstrap-4') }}



</div>
