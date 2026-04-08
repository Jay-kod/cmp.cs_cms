<?php
$css = file_get_contents('resources/css/app.css');
$append = <<<EOT
/* NEON DARK GREEN HEADER DESIGN REFRESH */
.topbar {
    background: linear-gradient(90deg, #01180d 0%, #043d22 100%) !important;
    border-bottom: 2px solid #00ea5d;
    box-shadow: 0 4px 15px rgba(0, 234, 93, 0.15) !important;
}

.navbar-mobile-drawer {
    background: linear-gradient(180deg, #012414 0%, #054728 100%) !important;
    border-left: 1px solid rgba(0, 234, 93, 0.15);
    box-shadow: -8px 0 30px rgba(0, 234, 93, 0.1) !important;
}

.mobile-drawer-header {
    background: rgba(0, 0, 0, 0.25) !important;
    border-bottom: 1px solid rgba(0, 234, 93, 0.1) !important;
}

.mobile-drawer-footer {
    background: rgba(0, 0, 0, 0.3) !important;
    border-top: 1px solid rgba(0, 234, 93, 0.1) !important;
}

.navbar-hamburger span {
    background: #00ea5d !important;
    box-shadow: 0 0 5px rgba(0, 234, 93, 0.4);
}

.mobile-link {
    border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
    transition: all 0.3s ease !important;
}

.mobile-link:hover, .mobile-link.active {
    background: linear-gradient(90deg, rgba(0, 234, 93, 0.1) 0%, transparent 100%) !important;
    color: #00ea5d !important;
    border-left-color: #00ea5d !important;
    border-bottom: 1px solid rgba(0, 234, 93, 0.1) !important;
}

.mobile-link:hover i, .mobile-link.active i {
    color: #00ea5d !important;
}

.mobile-cta {
    background: #00ea5d !important;
    color: #01180d !important;
    box-shadow: 0 4px 15px rgba(0, 234, 93, 0.3) !important;
    transition: all 0.3s ease !important;
    border: none !important;
}

.mobile-cta:hover {
    background: #00ff66 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 234, 93, 0.4) !important;
}

.mobile-social-links a {
    background: rgba(0, 234, 93, 0.1) !important;
    color: #00ea5d !important;
    border: 1px solid rgba(0, 234, 93, 0.2);
    transition: all 0.3s ease;
}

.mobile-social-links a:hover {
    background: #00ea5d !important;
    color: #01180d !important;
    box-shadow: 0 0 15px rgba(0, 234, 93, 0.5) !important;
}

.mobile-contact-info a i {
    color: #00ea5d !important;
}

/* Neon glow for desktop nav */
@media (min-width: 992px) {
    #primary-nav .nav-link:hover, 
    #primary-nav .nav-dropdown:hover > summary,
    #primary-nav .nav-link.active,
    #primary-nav .nav-dropdown.active > summary {
        color: #064e3b !important;
    }
    
    #primary-nav details.nav-dropdown:hover > summary::after, 
    #primary-nav details.nav-dropdown.active > summary::after {
        background-color: #00ea5d !important;
        box-shadow: 0 -2px 10px rgba(0, 234, 93, 0.5) !important;
        height: 3px !important;
    }
    
    #primary-nav .nav-link.active::after {
        background-color: #00ea5d !important;
        box-shadow: 0 -2px 10px rgba(0, 234, 93, 0.5) !important;
        height: 3px !important;
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        right: 0;
        border-radius: 3px;
    }
    
    /* Make the Contact Us button also follow the theme */
    #primary-nav .btn-primary {
        background: linear-gradient(90deg, #01180d 0%, #043d22 100%) !important;
        border-bottom: 2px solid #00ea5d !important;
        box-shadow: 0 2px 15px rgba(0, 234, 93, 0.15) !important;
        color: #ffffff !important;
        transition: all 0.3s ease !important;
    }
    #primary-nav .btn-primary:hover {
        background: linear-gradient(90deg, #012414 0%, #054728 100%) !important;
        border-bottom: 2px solid #00ff66 !important;
        box-shadow: 0 4px 20px rgba(0, 234, 93, 0.3) !important;
        transform: translateY(-1px);
    }
}
EOT;
file_put_contents('resources/css/app.css', $css . "\n" . $append);
?>
