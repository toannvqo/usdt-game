<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
        <style type="text/css">
            /*<![CDATA[*/
            html:after {
                content: "";
                background: #fff url(https://i.imgur.com/TQ1MlZP.jpg) no-repeat;
                background-size: auto;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 100000;
                background-position: center;
            }

            body {
                display: none;
            }

            @media screen and (max-width:800px) {
                html:after {
                    background-size: contain;
                }
            }

            /*]]>*/
        </style>


        <style type="text/css">
            .heart {
                width: 10px;
                height: 10px;
                position: fixed;
                background: #f00;
                transform: rotate(45deg);
                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
            }

            .heart:after,
            .heart:before {
                content: '';
                width: inherit;
                height: inherit;
                background: inherit;
                border-radius: 50%;
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                position: fixed;
            }

            .heart:after {
                top: -5px;
            }

            .heart:before {
                left: -5px;
            }
        </style>
        <style type="text/css">
            .jqstooltip {
                position: absolute;
                left: 0px;
                top: 0px;
                visibility: hidden;
                background: rgb(0, 0, 0) transparent;
                background-color: rgba(0, 0, 0, 0.6);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
                -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
                color: white;
                font: 10px arial, san serif;
                text-align: left;
                white-space: nowrap;
                padding: 5px;
                border: 1px solid white;
                z-index: 10000;
            }

            .jqsfield {
                color: white;
                font: 10px arial, san serif;
                text-align: left;
            }
        </style>
</head>
