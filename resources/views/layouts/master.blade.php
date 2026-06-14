<!doctype html>
<html lang="en">

<head>
  <title>Platforme SeaFood4Africa</title>
  <meta charset="utf-8">
  <meta name="Googlebot-News" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="robots" content="noimageindex">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" media="all" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" media="all" href="{{asset('css/slick.css')}}">
  <link rel="stylesheet" media="all" href="{{asset('css/slick-theme.css')}}">
  <link rel="stylesheet" media="all" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- F head dyal page -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

  <link rel="stylesheet" media="all" href="{{asset('css/navbar.css')}}">
  <link rel="stylesheet" media="all" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" media="all" href="{{asset('css/home.css')}}">
  @stack('styles')

  <link rel="icon" type="image/png" sizes="28x28" href="{{asset('img/favicon.webp')}}">
  <meta name="theme-color" content="#sdfsf">

</head>
<body class="themebgcolor">
<div class="circlebg1"><img class="img-fluid" src="{{asset('img/circlebg19.svg')}}" alt="img"></div>
  <div class="circlebg2"><img class="img-fluid" src="{{asset('img/circlebg20.svg')}}" alt="img"></div>
  <div class="circlebg3"><img class="img-fluid" src="{{asset('img/circlebg21.svg')}}" alt="img"></div>


{{-- Disclaimer Popup --}}
<div id="disclaimerOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,5,20,0.82); z-index:99999; align-items:center; justify-content:center;">
  <div style="background:#0a1628; border:1px solid rgba(1,157,234,0.25); border-radius:16px; max-width:480px; width:90%; padding:36px 32px; text-align:center; box-shadow:0 8px 48px rgba(0,0,0,0.6);">
    <div style="width:56px;height:56px;background:rgba(1,157,234,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
      <svg width="28" height="28" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#019DEA" stroke-width="1.8"/><path d="M12 8v4M12 16h.01" stroke="#019DEA" stroke-width="2" stroke-linecap="round"/></svg>
    </div>
    <h3 style="color:#ffffff;font-size:18px;font-weight:700;margin-bottom:12px;">Important Notice</h3>
    <p style="color:#B1BBD4;font-size:14px;line-height:1.7;margin-bottom:24px;">
      This platform is a <strong style="color:#019DEA;">B2B directory</strong> — our goal is to connect seafood companies and facilitate networking.<br><br>
      <strong style="color:#ffffff;">We do not facilitate direct buying or selling</strong> between companies. All transactions and agreements are made directly between the parties involved.
    </p>
    <button onclick="dismissDisclaimer()" style="background:#019DEA;color:#fff;border:none;border-radius:8px;padding:12px 40px;font-size:15px;font-weight:600;cursor:pointer;transition:background 0.2s;">
      I Understand
    </button>
  </div>
</div>

<script>
(function() {
    if (!localStorage.getItem('sf4a_disclaimer')) {
        var el = document.getElementById('disclaimerOverlay');
        el.style.display = 'flex';
    }
})();
function dismissDisclaimer() {
    localStorage.setItem('sf4a_disclaimer', '1');
    document.getElementById('disclaimerOverlay').style.display = 'none';
}
</script>

@include('Parcial.navbar')

@guest
{{-- EXCHANGE access modal — available on all pages for guests --}}
<div class="custom-modal" id="authModal">
    <div class="custom-modal-backdrop"></div>
    <div class="custom-modal-content">
        <button class="modal-close-btn" id="closeAuthModal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <div class="modal-icon">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                <circle cx="24" cy="24" r="20" stroke="#019DEA" stroke-width="2"/>
                <path d="M24 16V24M24 28H24.02" stroke="#019DEA" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
        <h3 class="modal-title">Access Required</h3>
        <p class="modal-text">Please log in or create an account to access the Resources section.</p>
        <div class="modal-actions">
            <a href="{{ route('login') }}" class="modal-btn modal-btn-primary">Log In</a>
            <a href="{{ route('register') }}" class="modal-btn modal-btn-secondary">Create Account</a>
        </div>
    </div>
</div>
@endguest

@yield('content')
@include('Parcial.footer')

<div id="elevator_item"><a id="elevator" onclick="return false;" title="Back To Top"></a></div>


<!-- Optional JavaScript -->
 <!-- 1. jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/slick.js')}}"></script>
<script src="{{asset('js/comman.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
<script src="{{asset('js/navbar.js')}}"></script>
@stack('scripts')

<script>
function filterUsers(categoryId) {
    $.ajax({
        url: '{{ route("home") }}',
        method: 'GET',
        data: { category_id: categoryId },
        success: function(response) { $('#user-list').html(response); },
        error: function(xhr) { console.error('Error fetching users:', xhr); }
    });
}
</script>

</body>
</html>