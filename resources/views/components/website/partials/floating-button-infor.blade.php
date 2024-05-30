<div class="cd__main">
    <div class="fab-container">
        <div class="fab shadow">
            <div class="fab-content">
                <span class="material-icons">support_agent</span>
            </div>
        </div>
        <div class="sub-button shadow">
            <a href="tel:0904031103" target="_blank">
                <span class="material-icons">phone</span>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="mailto:girc.tuaf@gmail.com" target="_blank">
                <span class="material-icons">mail_outline</span>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="https://www.google.com/" target="_blank">
                <span class="material-icons">help_outline</span>
            </a>
        </div>
    </div>
    <style>
        .fab-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            user-select: none;
            position: fixed;
            bottom: 30px;
            left: 30px;
        }

        .fab-container:hover {
            height: auto;
        }

        .fab-container:hover .sub-button {
            transform: translateY(-20px);
            opacity: 1;
        }

        .fab-container .sub-button {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            bottom: 20px;
            opacity: 0;
            transition: all 0.5s ease;
            height: 50px;
            width: 50px;
            background-color: #4ba2ff;
            border-radius: 50%;
            cursor: pointer;
        }

        .fab-container .sub-button:nth-child(2) {
            bottom: 60px;
        }

        .fab-container .sub-button:nth-child(3) {
            bottom: 120px;
        }

        .fab-container .sub-button:nth-child(4) {
            bottom: 180px;
        }

        .fab-container .sub-button:nth-child(5) {
            bottom: 240px;
        }

        .fab-container .fab {
            position: relative;
            height: 60px;
            width: 60px;
            background-color: #4ba2ff;
            border-radius: 50%;
            z-index: 2;
        }

        .fab-container .fab::before {
            content: " ";
            position: absolute;
            bottom: 0;
            right: 0;
            height: 35px;
            width: 35px;
            background-color: inherit;
            border-radius: 0 0 10px 0;
            z-index: -1;
        }

        .fab-container .fab .fab-content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            border-radius: 50%;
        }

        .fab-container .fab .fab-content .material-icons {
            color: white;
            font-size: 48px;
        }

        .fab-container .sub-button .material-icons {
            color: white;
            padding-top: 6px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.fab-container').hide();

            function checkScroll() {
                if ($(window).scrollTop() > 100) {
                    $('.fab-container').fadeIn();
                } else {
                    $('.fab-container').fadeOut();
                }
            }
            checkScroll();
            $(window).scroll(function() {
                checkScroll();
            });
        });
    </script>
</div>
