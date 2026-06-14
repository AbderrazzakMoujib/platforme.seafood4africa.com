@extends('layouts.master')
@section('content')
<div style="min-height:60vh;display:flex;align-items:center;justify-content:center;">
  <div style="background:#0a1628;border:1px solid rgba(1,157,234,0.2);border-radius:16px;max-width:500px;width:90%;padding:48px 36px;text-align:center;">
    <div style="width:64px;height:64px;background:rgba(1,157,234,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
      <svg width="32" height="32" fill="none" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 5v5l3 3" stroke="#019DEA" stroke-width="1.8" stroke-linecap="round"/></svg>
    </div>
    <h2 style="color:#fff;font-size:22px;font-weight:700;margin-bottom:12px;">Request Received!</h2>
    <p style="color:#B1BBD4;font-size:15px;line-height:1.7;margin-bottom:8px;">
      Your registration request has been submitted successfully.
    </p>
    <p style="color:#B1BBD4;font-size:14px;line-height:1.7;margin-bottom:32px;">
      Our team will review your information and contact you by email once your account is approved.
    </p>
    <a href="{{ url('/') }}" style="display:inline-block;background:#019DEA;color:#fff;text-decoration:none;border-radius:8px;padding:12px 36px;font-size:15px;font-weight:600;">
      Back to Home
    </a>
  </div>
</div>
@endsection
