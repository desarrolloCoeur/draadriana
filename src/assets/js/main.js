function docReady(fn){
    if(document.readyState === 'complete' || document.readyState === 'interactive'){
        setTimeout(fn, 1);
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}
docReady(() => {
    let links = document.querySelectorAll('nav .nav-links a');
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'),0);
    const $navbar = document.querySelector('nav.navbar');
    const $navbarBrands = Array.prototype.slice.call(
        document.querySelectorAll('.navbar-brand>.navbar-item>img')
    );
    const $navbarLinks = document.querySelector('#navbarLinks');
    const $navbarSocialIcons = Array.prototype.slice.call(
        document.querySelectorAll('.navbar-end a img')
    );
    
    links.forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            let target = event.currentTarget.getAttribute('href');

            document.querySelector(target).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    if($navbarBurgers.length > 0){
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {
                const nbTarget = el.dataset.target;
                const $nbTarget = document.getElementById(nbTarget);
                
                el.classList.toggle('is-active');
                $nbTarget.classList.toggle('is-active');
                
            });
            
        });
    }


    window.addEventListener('scroll', ()=>{
        let scrollLvl = window.scrollY;
        if(scrollLvl > 150){
            $navbarBrands[0].classList.add('show');
            $navbarBrands[1].classList.add('show');
            $navbarSocialIcons.forEach(icon => {
                icon.classList.remove('fixed')
            });
            $navbar.classList.add('follow');
        }
        else{
            $navbarBrands[0].classList.remove('show');
            $navbarBrands[1].classList.remove('show');
            $navbarSocialIcons.forEach(icon => {
                icon.classList.add('fixed')
            });
            $navbar.classList.remove('follow');
        }

    });

    bulmaCarousel.attach('#presentacion', {
        slidesToScroll: 1,
        slidesToShow: 1,
        pagination: false

    });
    bulmaCarousel.attach('#participaciones-carousel', {
        slidesToScroll: 1, 
        slidesToShow: 3,
        pagination: false
    });

    document.addEventListener('click', (e) => {
        if($navbarLinks.classList.contains('is-active')){
            if(e.target !== $navbarLinks && !e.target.classList.contains('navbar-burger')){
                $navbarLinks.classList.remove('is-active');
                $navbarBurgers.forEach(el => {
                    el.classList.remove('is-active');
                });
            }
        } 
    });

    $botonCita = document.querySelectorAll('.boton_cita');
    $botonCita.forEach(boton => {
        boton.addEventListener('click', (e) => {
            window.open('https://wa.me/5213222912787/');
        });
    });

});