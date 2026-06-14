@extends('layouts.master')
@section('content')


<!-- about sec -->
<div class="about-sec">
  <div class="container">
    <div class="row">
      <div class="col-xl-6">
        <div class="about-content">
          <h2 class="textwhitecolor abouth">plateforme - <span>B2B</span></h2>
          <p>Cette plateforme B2B est conçue pour faciliter les connexions entre les entreprises africaines du secteur de la pêche et de l'aquaculture. Elle permet de développer des partenariats stratégiques, d'explorer de nouvelles opportunités commerciales, et de renforcer le réseau professionnel à l’échelle continentale.

</p>          
        </div>
      </div>
      <div class="col-xl-6">
        <div class="about-img mt-5">
          <img src="img/images_header.png"  alt="img" class="img-fluid">
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/setupwalleticon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Marketplace</h3>
          </div>
          <p class="textgraycolor">Join a B2B marketplace connecting seafood professionals. Discover top products, services, and partners across Africa—simplifying sourcing, negotiations, and growth</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/collectionicon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Create your Resources</h3>
          </div>
          <p class="textgraycolor">Effortlessly manage your resources: create a profile, list certifications, showcase services, and highlight strengths—boosting visibility in seafood and aquaculture</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/addyouricon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Add your Products</h3>
          </div>
          <p class="textgraycolor">Easily upload and categorize your products—seafood, packaging, equipment, or services—to reach buyers and partners seeking quality solutions. </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/listthemicon.svg" alt="img"></div>
            <h3 class="textwhitecolor">List them for sale</h3>
          </div>
          <p class="textgraycolor">List products, connect directly with buyers, and negotiate deals seamlessly. Access a global market and boost sales with ease on our B2B platform. </p>
        </div>
      </div>
    </div>
    <div class="row about-row2 mt-3 mt-lg-3 mt-xl-5 pt-3 pt-lg-3 pt-xl-5">
      <div class="col-xl-6">
        <div class="about-img">
          <img src="img/dashboard.png" alt="img" class="img-fluid">
        </div>
      </div>
      <div class="col-xl-6 pb-5 pb-md-0">
        <div class="about-content">
          <h2 class="textwhitecolor abouth">Espace Unique </h2>
          <p>
          Elle offre un espace unique d’échanges B2B, où les participants peuvent partager des idées, collaborer sur des initiatives, et accéder à des ressources favorisant une croissance durable de l’industrie. En rejoignant cette plateforme, les entreprises bénéficient d’outils permettant de construire des relations durables et fructueuses avec d’autres professionnels du secteur.
          </p> 
          <div class="watch-btn">
            <button class="btn btnlightblue mt-5" ><a href="{{route('contact')}}" id="btn_header" >Contact Us</a></button>
          </div>        
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection