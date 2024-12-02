


document.addEventListener("DOMContentLoaded", function () {

    var footer = document.querySelector('footer');
    if (footer) {
        footer.innerHTML += `
            <div class="py-2 text-white font-medium" style="background: #151212" bis_skin_checked="1">
                <div class="max-w-6xl mx-auto text-center" bis_skin_checked="1">
                    Vận hành bởi <a href="/"> KUMA </a> - Developer by <a target="_blank" href="https://www.fb.com/707311">Bartholomew</a>
                </div>
            </div>
        `;
    }
    
        var message = "NoRightClicking";
    
        function defeatIE() {
            if (document.all) {
               
                return false;
            }
        }
    
        function defeatNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                   
                    return false;
                }
            }
        }
    
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = defeatNS;
        } else {
            document.onmouseup = defeatNS;
            document.oncontextmenu = defeatIE;
        }
        document.oncontextmenu = new Function("return false");
    
        var checkCtrl = false;
        document.addEventListener("keydown", function (e) {
            if (e.keyCode == 17) {
                checkCtrl = false;
            }
        });
    
        document.addEventListener("keyup", function (ev) {
            if (ev.keyCode == 17) {
                checkCtrl = false;
            }
        });
    
        document.addEventListener("keydown", function (event) {
            if (checkCtrl) {
                if (event.keyCode == 85) {
                    return false;
                }
            }
        });
    });
    