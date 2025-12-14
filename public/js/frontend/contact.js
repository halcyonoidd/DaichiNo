window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 100) {
        navbar.classList.remove('transparent');
        navbar.classList.add('solid');
    } else {
        navbar.classList.remove('solid');
        navbar.classList.add('transparent');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const sushiPieces = document.querySelectorAll('.sushi-piece');
    const contactModal = document.querySelector('.contact-modal');
    const closeModal = document.querySelector('.close-modal');
    const contactTitle = document.getElementById('contact-title');
    const contactSubtitle = document.getElementById('contact-subtitle');
    const contactItems = document.querySelectorAll('.contact-item');
    
    const contactData = {
        phone: {
            title: "Phone Contact",
            subtitle: "Call us directly",
            activeClass: "phone-contact"
        },
        email: {
            title: "Email Contact", 
            subtitle: "Send us a message",
            activeClass: "email-contact"
        },
        address: {
            title: "Location",
            subtitle: "Visit our restaurant",
            activeClass: "address-contact"
        },
        hours: {
            title: "Business Hours",
            subtitle: "When we're open",
            activeClass: "hours-contact"
        },
        social: {
            title: "Social Media",
            subtitle: "Connect with us online",
            activeClass: "social-contact"
        },
        reservation: {
            title: "Make a Reservation",
            subtitle: "Book your table",
            activeClass: "reservation-contact"
        }
    };

    let activeContactClass = null;

    function updateContactVisibility() {
        contactItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(10px)';
            item.style.pointerEvents = 'none';
            item.style.position = 'absolute';
            item.style.top = '0';
            item.style.left = '0';
            item.style.right = '0';
            item.style.visibility = 'hidden';

            if (item.classList.contains(activeContactClass)) {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
                item.style.pointerEvents = 'auto';
                item.style.position = 'relative';
                item.style.visibility = 'visible';
            }
        });
    }

    updateContactVisibility();

    sushiPieces.forEach(sushi => {
        sushi.addEventListener('click', function() {
            const contactType = this.getAttribute('data-contact');
            const data = contactData[contactType];
            
            contactTitle.textContent = data.title;
            contactSubtitle.textContent = data.subtitle;
            
            activeContactClass = data.activeClass;

            sushiPieces.forEach(s => s.classList.remove('active'));

            this.classList.add('active');
            
            contactModal.classList.add('active');

            setTimeout(() => {
                updateContactVisibility();
            }, 50);
        });
    });
    
    closeModal.addEventListener('click', function() {
        contactItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(10px)';
        });
        
        setTimeout(() => {
            contactModal.classList.remove('active');

            sushiPieces.forEach(s => s.classList.remove('active'));

            activeContactClass = null;
        }, 300);
    });
    
    contactModal.addEventListener('click', function(e) {
        if (e.target === contactModal) {
            contactItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(10px)';
            });
            
            setTimeout(() => {
                contactModal.classList.remove('active');

                sushiPieces.forEach(s => s.classList.remove('active'));

                activeContactClass = null;
            }, 300);
        }
    });

    sushiPieces.forEach(sushi => {
        sushi.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(-5px)';
            }
        });
        
        sushi.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const floatingUserBtn = document.getElementById('floating-user-btn');
    const userPanel = document.getElementById('user-panel');
    const closePanelBtn = document.getElementById('close-panel');
    const panelOverlay = document.getElementById('panel-overlay');
    const logoutBtn = document.getElementById('logout-btn');

    function openUserPanel() {
        userPanel.classList.add('open');
        panelOverlay.classList.add('active');
        floatingUserBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeUserPanel() {
        userPanel.classList.remove('open');
        panelOverlay.classList.remove('active');
        floatingUserBtn.classList.remove('active');
        document.body.style.overflow = '';
    }

    floatingUserBtn.addEventListener('click', openUserPanel);

    closePanelBtn.addEventListener('click', closeUserPanel);

    panelOverlay.addEventListener('click', closeUserPanel);
    
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && userPanel.classList.contains('open')) {
            closeUserPanel();
        }
    });
    
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Logout sekarang?')) {
            const form = document.getElementById('logout-form');
            if (form) {
                form.submit();
            }
        }
    });
    
    //data

    updateUserStats();
    
    let panelTouchStartY = 0;
    let panelTouchStartTime = 0;
    
    userPanel.addEventListener('touchstart', e => {
        panelTouchStartY = e.touches[0].clientY;
        panelTouchStartTime = Date.now();
    });
    
    userPanel.addEventListener('touchend', e => {
        const panelTouchEndY = e.changedTouches[0].clientY;
        const panelTouchDeltaY = panelTouchEndY - panelTouchStartY;
        const panelTouchDuration = Date.now() - panelTouchStartTime;

        if (panelTouchDeltaY > 100 || (panelTouchDeltaY > 50 && panelTouchDuration < 300)) {
            closeUserPanel();
        }
    });

    window.addEventListener('scroll', function() {
        const scrollIndicator = document.querySelector('.scroll-indicator');
        const scrollPosition = window.scrollY;
        
        if (scrollPosition > 100) {
            scrollIndicator.innerHTML = '<i class="fas fa-check mr-2"></i> Button stays visible';
        } else {
            scrollIndicator.innerHTML = '<i class="fas fa-arrow-down mr-2"></i> Scroll to test';
        }
    });
});