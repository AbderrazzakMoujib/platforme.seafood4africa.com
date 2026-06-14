@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/resources.css') }}">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/7.9.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/topojson/3.0.2/topojson.min.js"></script>
    <script src="{{ asset('js/resources.js') }}"></script>
@endpush

@section('content')

@php
    $normalize = function($s) {
        $s = mb_strtolower(trim($s));
        $s = str_replace('_', ' ', $s);
        $map = ['é'=>'e','è'=>'e','ê'=>'e','ë'=>'e','à'=>'a','â'=>'a','ä'=>'a',
                'î'=>'i','ï'=>'i','ô'=>'o','ö'=>'o','ù'=>'u','û'=>'u','ü'=>'u','ç'=>'c',
                'ó'=>'o','ú'=>'u','í'=>'i','á'=>'a','ñ'=>'n','ã'=>'a','õ'=>'o'];
        return strtr($s, $map);
    };

    // name (normalized) → ISO alpha-2
    $isoMap = [
        // Morocco
        'maroc' => 'MA', 'morocco' => 'MA',
        // West Africa
        'mauritania' => 'MR',
        'senegal' => 'SN',
        'guinea' => 'GN', 'guinee' => 'GN',
        'guinea bissau' => 'GW', 'guinee bissau' => 'GW',
        'sierra leone' => 'SL',
        'liberia' => 'LR', 'liberie' => 'LR',
        "cote d'ivoire" => 'CI', 'cote divoire' => 'CI', 'ivory coast' => 'CI',
        'ghana' => 'GH',
        'togo' => 'TG',
        'benin' => 'BJ',
        'nigeria' => 'NG',
        'burkina faso' => 'BF',
        'mali' => 'ML',
        'niger' => 'NE',
        'cape verde' => 'CV', 'cabo verde' => 'CV',
        'gambia' => 'GM',
        // Central Africa
        'cameroon' => 'CM', 'cameroun' => 'CM',
        'gabon' => 'GA',
        'republic of the congo' => 'CG', 'congo' => 'CG', 'congo brazzaville' => 'CG',
        'democratic republic of congo' => 'CD', 'democratic republic of the congo' => 'CD',
        'democratic' => 'CD', 'dr congo' => 'CD', 'drc' => 'CD', 'congo kinshasa' => 'CD',
        'central african republic' => 'CF',
        'chad' => 'TD', 'tchad' => 'TD',
        'equatorial guinea' => 'GQ',
        'sao tome and principe' => 'ST',
        // North Africa
        'egypt' => 'EG',
        'libya' => 'LY',
        'tunisia' => 'TN',
        'algeria' => 'DZ',
        'sudan' => 'SD',
        'south sudan' => 'SS',
        'djibouti' => 'DJ',
        'eritrea' => 'ER',
        // East Africa
        'ethiopia' => 'ET',
        'kenya' => 'KE',
        'somalia' => 'SO',
        'uganda' => 'UG',
        'rwanda' => 'RW',
        'burundi' => 'BI',
        'tanzania' => 'TZ',
        'mozambique' => 'MZ',
        'madagascar' => 'MG',
        'comoros' => 'KM',
        'mauritius' => 'MU',
        'seychelles' => 'SC',
        // Southern Africa
        'south africa' => 'ZA',
        'namibia' => 'NA',
        'botswana' => 'BW',
        'zimbabwe' => 'ZW',
        'zambia' => 'ZM',
        'malawi' => 'MW',
        'lesotho' => 'LS',
        'eswatini' => 'SZ', 'swaziland' => 'SZ',
        'angola' => 'AO',
        'western sahara' => 'EH',
    ];

    // ISO alpha-2 → ISO numeric (topojson IDs)
    $isoNumeric = [
        'MA'=>504, 'MR'=>478, 'SN'=>686, 'GN'=>324, 'GW'=>624, 'SL'=>694,
        'LR'=>430, 'CI'=>384, 'GH'=>288, 'TG'=>768, 'BJ'=>204, 'NG'=>566,
        'BF'=>854, 'ML'=>466, 'NE'=>562, 'CV'=>132, 'GM'=>270,
        'CM'=>120, 'GA'=>266, 'CG'=>178, 'CD'=>180, 'CF'=>140, 'TD'=>148,
        'GQ'=>226, 'ST'=>678,
        'EG'=>818, 'LY'=>434, 'TN'=>788, 'DZ'=>12,
        'SD'=>729, 'SS'=>728, 'DJ'=>262, 'ER'=>232,
        'ET'=>231, 'KE'=>404, 'SO'=>706, 'UG'=>800, 'RW'=>646, 'BI'=>108,
        'TZ'=>834, 'MZ'=>508, 'MG'=>450, 'KM'=>174, 'MU'=>480, 'SC'=>690,
        'ZA'=>710, 'NA'=>516, 'BW'=>72, 'ZW'=>716, 'ZM'=>894, 'MW'=>454,
        'LS'=>426, 'SZ'=>748, 'AO'=>24, 'EH'=>732,
    ];

    $activeCountries = [];
    foreach ($countries as $country) {
        $key = $normalize($country->name);
        $iso = $isoMap[$key] ?? null;
        if ($iso && isset($isoNumeric[$iso])) {
            $flagFile = mb_strtolower(str_replace(' ', '_', trim($country->name)));
            $activeCountries[$isoNumeric[$iso]] = [
                'iso'  => $iso,
                'name' => $country->name,
                'url'  => route('user.media', ['id' => $country->id]),
                'flag' => asset('img/flag/' . $flagFile . '.png'),
            ];
        }
    }
@endphp

<script>
window.AFRICA_ACTIVE = @json($activeCountries);
</script>

<div class="resources-page">
  <div class="container">

    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="headingWh mt-5 mb-2">Best Practices Exchange</h2>
        <p class="resources-subtitle">Click on a country to explore its resources</p>
      </div>
    </div>

    <div class="resources-layout">

      <div class="africa-map-wrapper">
        <div class="map-tooltip" id="mapTooltip">
          <img id="tooltipFlag" src="" alt="">
          <span id="tooltipName"></span>
        </div>
        <div class="map-loading" id="mapLoading">
          <svg width="32" height="32" viewBox="0 0 32 32">
            <circle cx="16" cy="16" r="12" fill="none" stroke="#019DEA" stroke-width="3"
              stroke-dasharray="40" stroke-dashoffset="15"
              style="animation: mapSpin 1s linear infinite; transform-origin: center;">
            </circle>
          </svg>
          <span>Loading map...</span>
        </div>
        <svg id="africaMap" class="africa-svg" aria-label="Interactive map of Africa"></svg>
      </div>

      <div class="countries-grid">
        @foreach($countries as $country)
          @php
            $key = $normalize($country->name);
            $iso = $isoMap[$key] ?? null;
            $flagFile = mb_strtolower(str_replace(' ', '_', trim($country->name)));
          @endphp
          <a href="{{ route('user.media', ['id' => $country->id]) }}"
             class="country-card{{ $iso ? ' has-map' : '' }}"
             data-iso="{{ $iso }}">
            <div class="country-flag">
              <img src="{{ asset('img/flag/' . $flagFile . '.png') }}"
                   alt="{{ $country->name }}"
                   onerror="this.src='{{ asset('img/flag/maroc.png') }}'">
            </div>
            <span class="country-name">{{ $country->name }}</span>
            <i class="fas fa-chevron-right country-arrow"></i>
          </a>
        @endforeach
      </div>

    </div>

  </div>
</div>

@endsection