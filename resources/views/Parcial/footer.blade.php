<!-- Footer - SeaFood4Africa Style -->
<footer class="seafood-footer">
  <div class="container">
    <div class="row">
      <!-- Logo & Description Section -->
      <div class="col-lg-4 mb-4 mb-lg-0 order-first order-lg-0">
        <div class="footer-brand-section">
          <a href="{{ route('home') }}" class="footer-brand-logo">
            <img src="{{ asset("img/LOGO- SEAFOOD 4 AFRICA FORUM AFRICAIN DE L'INDUSTRIE DE LA PÊCHE ET DE L'AQUACULTURE MAROC - DAKHLA - 04 AU 06 FEVRIER 2026_2nd EDITION_white.webp") }}" alt="SeaFood4Africa Platform Logo" class="img-fluid">
          </a>
          <p class="footer-brand-description">
            African Forum of the Fishing and Aquaculture Industry - SeaFood4Africa
          </p>
          <div class="footer-contact-info">
            <p class="mb-2">
              <i class="fas fa-map-marker-alt me-2"></i>
              Ghmara Street (formerly El Yarmouk), Longchamp District, Casablanca
            </p>
            <p class="mb-2">
              <i class="fas fa-phone me-2"></i>
              <a href="tel:+212522944894">+212 5 22 94 48 94</a>
            </p>
            <p class="mb-0">
              <i class="fas fa-envelope me-2"></i>
              <a href="mailto:fenip@fenip.com">fenip@fenip.com</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Quick Links Section -->
      <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
        <div class="footer-links-section">
          <h4 class="footer-section-title">Quick Links</h4>
          <ul class="footer-links-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('b2b') }}">Réseau B2B</a></li>
            <li><a href="{{ route('product') }}">Produits</a></li>
            <li><a href="{{ route('resources') }}">Ressources</a></li>
            <li><a href="{{ route('about') }}">À Propos</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
          </ul>
        </div>
      </div>

      <!-- Event Information Section -->
      <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
        <div class="footer-event-section">
          <h4 class="footer-section-title">Event Information</h4>
          <div class="event-details">
            <div class="event-detail-item mb-3">
              <strong>Event Dates</strong>
              <p>04 - 06 February 2026</p>
            </div>
            <div class="event-detail-item mb-3">
              <strong>Venue</strong>
              <p>Dakhla, Morocco</p>
            </div>
            <div class="event-detail-item">
              <strong>Organized by</strong>
              <a href="https://fenip.com/" target="_blank" rel="noopener noreferrer">
                <img src="https://seafood4africa.com/assets/img/fenip-logo-site-.png" alt="FENIP Logo" class="fenip-logo">
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Stay Connected Section -->
      <div class="col-lg-2 col-md-12">
        <div class="footer-social-section">
          <h4 class="footer-section-title">Stay Connected</h4>
          <p class="social-subtitle">Follow for get every single updates</p>
          <div class="footer-social-icons">
            <a href="https://www.facebook.com/profile.php?id=61566470256327" class="social-icon-link" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.linkedin.com/company/seafood4africa-dakhla-2024/?viewAsMember=true" class="social-icon-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://www.instagram.com/" class="social-icon-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com/" class="social-icon-link" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <p class="footer-copyright mb-0">
            {{ date('Y') }} Copyright {{ date('Y') }} - 
            <a href="https://fenip.com/" target="_blank" rel="noopener noreferrer">FENIP</a>
          </p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <div class="footer-legal-links">
            <a href="{{ route('term') }}">Terms & Conditions</a>
            <span class="separator">|</span>
            <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
            <span class="separator">|</span>
            <span>Designed by <a href="https://smarteventsmorocco.com" target="_blank" rel="noopener noreferrer">Smart Events Morocco</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
