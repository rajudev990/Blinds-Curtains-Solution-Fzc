<x-app-layout>
    @php
    $title = \App\Models\SectionTitle::first();
    @endphp
    <main class="main">
        <section class="help__section">
            <div class="container">
                <div class="general-guides-container" style="background: transparent;">
                    <div class="headding_general">
                        <h2 class="p-0">
                            {{ $title->help_section_title }}
                        </h2>
                    </div>
                    <div class="general-guides-tabs">
                        <div class="tabs_main">
                            <div class="tabs__guides">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($help_title as $index => $item)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($index === 0) active @endif" 
                                                id="tab-{{ $index }}-tab" 
                                                data-bs-toggle="tab"
                                                data-bs-target="#tab-{{ $index }}" 
                                                type="button" 
                                                role="tab"
                                                aria-controls="tab-{{ $index }}" 
                                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $item->name }}
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content px-5" id="myTabContent">
                            @foreach ($help_title as $index => $item)
                            <div class="tab-pane fade @if($index === 0) show active @endif" 
                                 id="tab-{{ $index }}" 
                                 role="tabpanel"
                                 aria-labelledby="tab-{{ $index }}-tab">
                                <div class="faq__body help_body p-4">
                                    <div class="main-faq">
                                        <h2 class="support-presentation-title">{{ $item->name }}</h2>
                                    </div>
                                    <div class="accordion mb-5" id="accordionPanelsStayOpenExample-{{ $index }}">
                                        @foreach ($item->helps as $rowIndex => $row)
                                        <div class="accordion-item mb-2">
                                            <h2 class="accordion-header" id="heading-{{ $index }}-{{ $rowIndex }}">
                                                <button class="accordion-button collapsed" 
                                                        type="button"
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#collapse-{{ $index }}-{{ $rowIndex }}"
                                                        aria-expanded="false" 
                                                        aria-controls="collapse-{{ $index }}-{{ $rowIndex }}">
                                                    {{ $row->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $index }}-{{ $rowIndex }}" 
                                                 class="accordion-collapse collapse"
                                                 aria-labelledby="heading-{{ $index }}-{{ $rowIndex }}"
                                                 data-bs-parent="#accordionPanelsStayOpenExample-{{ $index }}">
                                                <div class="accordion-body">
                                                    <p>{{ $row->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
