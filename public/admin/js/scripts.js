// get the close btn
var alert_button = document.getElementsByClassName("alert-btn-close");


// check if the page have dropdwon menu
var dropdown = document.getElementsByClassName("dropdown");

if (dropdown.length >= 1) {
    for (let i = 0; i < dropdown.length; i++) {
        const item = dropdown[i];

        var menu, btn, overflow;

        item.addEventListener("click", function() {
            for (let i = 0; i < this.children.length; i++) {
                const e = this.children[i];

                if (e.classList.contains("menu")) {
                    menu = e;
                } else if (e.classList.contains("menu-btn")) {
                    btn = e;
                } else if (e.classList.contains("menu-overflow")) {
                    overflow = e;
                }
            }

            if (menu.classList.contains("hidden")) {
                // show the menu
                showMenu();
            } else {
                // hide the menu
                hideMenu();
            }
        });

        var showMenu = function() {
            menu.classList.remove("hidden");
            menu.classList.add("fadeIn");
            overflow.classList.remove("hidden");
        };

        var hideMenu = function() {
            menu.classList.add("hidden");
            overflow.classList.add("hidden");
            menu.classList.remove("fadeIn");
        };
    }
}

var first = [
    "Aaran",
    "Aaren",
];

var getRandomInt = function(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
};

var generateName = function(num) {
    if (num === 1) {
        var name = first[getRandomInt(0, first.length + 1)];
    } else {
        var name =
            first[getRandomInt(0, first.length + 1)] +
            " " +
            last[getRandomInt(0, first.length + 1)];
    }

    return name;
};

var names = document.getElementsByClassName("name-1");
var names_2 = document.getElementsByClassName("name-2");

if (names.length > 0) {
    for (let i = 0; i < names.length; i++) {
        const e = names[i];
        e.innerText = generateName(1);
    }
}

if (names_2.length > 0) {
    for (let i = 0; i < names_2.length; i++) {
        const e = names_2[i];
        e.innerText = generateName(2);
    }
}
var navbarToggle = document.getElementById("navbarToggle"),
    navbar = document.getElementById("navbar");

navbarToggle.addEventListener("click", function() {
    if (navbar.classList.contains("md:hidden")) {
        navbar.classList.remove("md:hidden");
        navbar.classList.add("fadeIn");
    } else {
        var _classRemover = function() {
            navbar.classList.remove("fadeIn");
            navbar.classList.add("fadeOut");
        };

        var animate = async function() {
            await _classRemover();

            setTimeout(function() {
                navbar.classList.add("md:hidden");
                navbar.classList.remove("fadeOut");
            }, 450);
        };

        animate();
    }
});
var num = function(from, to) {
    return Math.floor(Math.random() * to) + from;
};

// array of number
var numArr = function(length, max) {
    return Array.from({ length: length }, () =>
        Math.floor(Math.random() * max)
    );
};

// return 2 digit
var el_2 = document.getElementsByClassName("num-2");
var display_2 = function() {
    for (let i = 0; i < el_2.length; i++) {
        const e = el_2[i];

        e.innerText = num(1, 99);
    }
};

if (el_2.length > 0) {
    display_2();
}
// end 2 digit

// return 3 digit
var el_3 = document.getElementsByClassName("num-3");
var display_3 = function() {
    for (let i = 0; i < el_3.length; i++) {
        const e = el_3[i];

        e.innerText = num(99, 999);
    }
};

if (el_3.length > 0) {
    display_3();
}
// end 3 digit

// return 4 digit
var el_4 = document.getElementsByClassName("num-4");
var display_4 = function() {
    for (let i = 0; i < el_4.length; i++) {
        const e = el_4[i];

        e.innerText = num(999, 9999);
    }
};

if (el_4.length > 0) {
    display_4();
}
// end 4 digits

// work with sidebar
var btn = document.getElementById("sliderBtn"),
    sideBar = document.getElementById("sideBar"),
    sideBarBackground = document.getElementById("navbar-overlay"),
    sideBarHideBtn = document.getElementById("sideBarHideBtn");

// show sidebar
btn.addEventListener("click", function() {
    if (sideBar.classList.contains("md:-ml-64")) {
        sideBar.classList.replace("md:-ml-64", "md:ml-0");
        sideBar.classList.remove("md:slideOutLeft");
        sideBar.classList.add("md:slideInLeft");
        sideBarBackground.classList.remove("hidden");
    }
});

// hide sideBar
function hideSideBar() {
    sideBarBackground.classList.add("hidden");
    if (sideBar.classList.contains("md:ml-0", "slideInLeft")) {
        var _class = function() {
            sideBar.classList.remove("md:slideInLeft");
            sideBar.classList.add("md:slideOutLeft");
        };
        var animate = async function() {
            await _class();

            setTimeout(function() {
                sideBar.classList.replace("md:ml-0", "md:-ml-64");
            }, 300);
        };

        _class();
        animate();
    }
}
sideBarBackground.addEventListener("click", hideSideBar);
sideBarHideBtn.addEventListener("click", hideSideBar);
// end with sidebar
