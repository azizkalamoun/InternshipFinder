$(document).ready(function () {
    var btn = $("#back-to-top-button");

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass("show");
            console.log($(window).scrollTop());
        } else {
            btn.removeClass("show");
        }
    });

    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "300");
    });
});
//////////////////////////////////////////////////////////////////////////
const cursor = document.querySelector(".circle");

function getDimensions(e) {
    cursor.style.top = `${e.clientY - 25}px`;
    cursor.style.left = `${e.clientX - 25}px`;
}

if (
    window.location.pathname === "/index.html" ||
    window.location.pathname === "/"
) {
    window.addEventListener(
        "mousemove",
        throttle(function (e) {
            getDimensions(e);
        })
    );
}

function throttle(callback, limit) {
    let wait = false;
    return function () {
        if (!wait) {
            callback.apply(null, arguments);
            wait = true;
            setTimeout(function () {
                wait = false;
            }, limit);
        }
    };
}

//////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
    const itemTriggers = document.querySelectorAll(".item-trigger");
    const modals = document.querySelectorAll(".details-modal");
    const closeModalBtns = document.querySelectorAll(".close");
    const leftArrows = document.querySelectorAll(".leftArrow");
    const rightArrows = document.querySelectorAll(".rightArrow");
    const body = document.body;

    itemTriggers.forEach(function (trigger, index) {
        trigger.addEventListener("click", function () {
            body.classList.add("modal-open");
            modals[index].classList.remove("hidden");
            const images = modals[index].querySelectorAll(".company-image");
            let currentImageIndex = 0;

            function showImage(index) {
                images.forEach((image, i) => {
                    if (i === index) {
                        image.style.opacity = 1;
                        image.style.zIndex = 1;
                    } else {
                        image.style.opacity = 0;
                        image.style.zIndex = 0;
                    }
                });
            }

            showImage(currentImageIndex);

            rightArrows[index].addEventListener("click", function () {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                showImage(currentImageIndex);
            });

            leftArrows[index].addEventListener("click", function () {
                currentImageIndex =
                    (currentImageIndex - 1 + images.length) % images.length;
                showImage(currentImageIndex);
            });
        });
    });

    closeModalBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            body.classList.remove("modal-open");
            modals.forEach(function (modal) {
                modal.classList.add("hidden");
            });
            rightArrows.forEach(function (arrow) {
                arrow.removeEventListener("click", handleArrowClick);
            });
            leftArrows.forEach(function (arrow) {
                arrow.removeEventListener("click", handleArrowClick);
            });
        });
    });

    function handleArrowClick(direction, arrow, images) {
        const modalId = arrow.getAttribute("data-company-id");
        const modal = document.getElementById(`details-${modalId}`);
        let currentImageIndex = 0;

        const companyImages = images[modalId]; // Assuming images is an associative array with company_id as keys

        function showImage(index) {
            companyImages.forEach((image, i) => {
                if (i === index) {
                    image.style.opacity = 1;
                    image.style.zIndex = 1;
                } else {
                    image.style.opacity = 0;
                    image.style.zIndex = 0;
                }
            });
        }

        showImage(currentImageIndex);

        if (direction === "right") {
            arrow.addEventListener("click", function () {
                currentImageIndex =
                    (currentImageIndex + 1) % companyImages.length;
                showImage(currentImageIndex);
            });
        } else {
            arrow.addEventListener("click", function () {
                currentImageIndex =
                    (currentImageIndex - 1 + companyImages.length) %
                    companyImages.length;
                showImage(currentImageIndex);
            });
        }
    }
});

function filterCompanies() {
    var selectedRegion = document.getElementById("region").value.toLowerCase();
    var items = document.querySelectorAll(".item");

    items.forEach(function (item) {
        var companyRegion = item
            .getAttribute("data-company-region")
            .toLowerCase();

        if (selectedRegion === "" || selectedRegion === companyRegion) {
            item.classList.remove("hidden");
        } else {
            item.classList.add("hidden");
        }
    });
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
function changeIframeLink() {
    var selectElement = document.getElementById("niveau_de_stage");
    var iframeElement = document.getElementById("iframeContainer");

    var selectedOption =
        selectElement.options[selectElement.selectedIndex].value;

    var initiationLink =
        "https://drive.google.com/file/d/1_65_hdPf07nRkkq9WHGJG-vsh9R0MXbZ/preview";
    var perfectionnementLink =
        "https://drive.google.com/file/d/1N_pASxeTFdd4Ktab1WYpFwB73QsbHrsw/preview";
    var finEtudeLink =
        "https://drive.google.com/file/d/1HsvNogfojYfAKOtIscPubxNB6HuJp9gn/preview";

    var newLink = "";
    switch (selectedOption) {
        case "initiation":
            newLink = initiationLink;
            examplePaper.style.opacity = 0;
            examplePaper.style.height = "0";
            break;
        case "perfectionnement":
            newLink = perfectionnementLink;
            examplePaper.style.opacity = 0;
            examplePaper.style.height = "0";
            break;
        case "fin_etude":
            newLink = finEtudeLink;
            examplePaper.style.opacity = 0;
            examplePaper.style.height = "0";
            break;
        default:
            break;
    }
    iframeElement.src = newLink;

    setTimeout(function () {
        examplePaper.style.opacity = 1;
        examplePaper.style.height = "100rem";
    }, 1000);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////