@extends('layouts.admin.admin_app')
@section('admin_js_link')
     <script src="{{ asset('admin_assets') }}/js/printThis.js"></script>
@endsection
@section('site_title')
   Show Booking Information | Bir Beauty
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Show Booking Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Show Booking Information</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <section id="demo">
            <div
                style="font-family: sans-serif; width:235px; min-height:377px; margin: 0 auto;text-transform:capitalize;color:#000; padding:5px;background: #fff;overflow: hidden;border: 1px dotted #444;">
                <div style="min-height:357px;font-size:11px;background: #fff;margin: 0 auto;">
                    <div class="store-info">
                        <div style="display: flex;">
                            <div style="width: 100%; text-align: center;
                                     margin-bottom: 5px;">
                                <!-- <img src="./assets/image/pos80mm/favicon82.png" alt="logo" style="width: 30%;margin-bottom: 5px;"> -->
                                <!-- SVG Logo Start-->
                                <svg
                                    version="1.0"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="100px"
                                    height="100px"
                                    viewBox="0 0 1444.000000 1869.000000"
                                    preserveAspectRatio="xMidYMid meet">

                                    <g
                                        transform="translate(0.000000,1869.000000) scale(0.100000,-0.100000)"
                                        fill="#000000"
                                        stroke="none">
                                        <path
                                            d="M8240 18350 c11 -28 29 -69 40 -91 35 -67 181 -475 221 -614 162
                                -568 225 -894 284 -1470 22 -207 30 -687 16 -920 -14 -245 -53 -561 -96 -785
                                -9 -47 -20 -107 -25 -135 -11 -67 -32 -144 -119 -448 -43 -151 -59 -196 -101
                                -302 -16 -38 -50 -124 -75 -190 -44 -112 -82 -196 -174 -385 -96 -195 -288
                                -514 -444 -735 -69 -99 -88 -123 -217 -289 -196 -252 -519 -588 -836 -870
                                -231 -205 -578 -545 -805 -787 -251 -269 -340 -368 -509 -576 -44 -54 -97
                                -118 -118 -143 -21 -25 -56 -70 -77 -100 -21 -30 -55 -75 -75 -100 -20 -25
                                -58 -76 -84 -115 -26 -38 -70 -102 -99 -142 -79 -109 -215 -321 -309 -483 -86
                                -146 -268 -481 -268 -493 0 -6 -22 -54 -111 -245 -22 -46 -39 -86 -39 -89 0
                                -5 -71 -193 -91 -238 -40 -96 -65 -171 -147 -445 -65 -216 -107 -389 -146
                                -600 -9 -47 -22 -121 -31 -165 -23 -126 -53 -330 -65 -455 -6 -63 -15 -156
                                -21 -206 -22 -218 -31 -783 -20 -1183 7 -218 16 -436 21 -486 5 -49 14 -142
                                20 -205 51 -519 220 -1175 433 -1680 83 -198 228 -497 286 -590 15 -25 47 -79
                                71 -120 126 -216 312 -478 501 -705 107 -129 423 -454 477 -491 47 -33 42 -7
                                -48 210 -53 130 -221 632 -255 766 -15 58 -32 119 -37 135 -61 193 -153 632
                                -208 995 -74 487 -82 1104 -19 1505 54 341 121 584 230 837 32 76 59 139 59
                                141 0 4 38 73 164 294 89 157 229 368 361 544 33 44 76 102 95 129 113 156
                                473 527 650 672 241 197 465 335 735 454 137 60 153 65 335 119 63 19 177 55
                                253 80 191 63 381 91 516 76 53 -5 146 -13 206 -16 61 -3 139 -10 175 -15 36
                                -6 115 -14 175 -19 61 -6 207 -20 325 -31 296 -30 627 -24 800 13 299 65 514
                                172 688 341 95 92 149 168 211 296 102 211 104 273 16 600 -45 169 -58 263
                                -53 363 7 128 33 175 183 322 106 104 125 127 141 175 26 76 24 182 -3 235
                                -39 75 -137 144 -275 195 -51 19 -58 25 -58 48 0 24 9 31 73 60 80 36 205 131
                                250 190 41 53 85 143 102 209 26 101 24 107 -65 191 -193 181 -288 366 -325
                                632 -9 67 20 193 62 270 41 74 143 184 253 273 110 89 260 233 298 286 59 82
                                75 127 76 221 0 80 -2 89 -36 151 -45 79 -116 150 -223 222 -196 131 -374 282
                                -525 443 -156 167 -193 212 -309 370 -282 382 -398 612 -442 874 -5 30 -14
                                249 -19 485 -11 510 -19 574 -117 975 -72 297 -193 655 -312 925 -84 190 -253
                                529 -321 645 -31 52 -72 122 -90 155 -19 33 -51 85 -72 115 -21 30 -62 91 -92
                                135 -133 199 -333 442 -488 591 -84 81 -217 192 -268 223 -55 33 -62 28 -40
                                -29z"/>
                                        <path
                                            d="M3700 17698 c-29 -98 -185 -402 -255 -498 -18 -25 -47 -72 -64 -105
                                -18 -33 -49 -83 -69 -112 -73 -101 -102 -144 -118 -174 -8 -17 -31 -51 -50
                                -76 -91 -120 -237 -488 -274 -692 -69 -381 -69 -508 1 -824 11 -49 24 -96 29
                                -105 5 -10 20 -43 34 -75 32 -73 149 -261 191 -307 17 -19 40 -48 50 -65 10
                                -16 44 -57 75 -90 31 -33 69 -78 85 -100 31 -43 474 -495 485 -495 10 0 50 87
                                81 175 82 237 108 318 127 400 72 319 96 602 79 953 -5 111 -7 209 -3 217 8
                                21 60 19 78 -2 18 -23 70 -161 103 -278 25 -88 34 -136 56 -320 13 -102 7
                                -404 -9 -510 -6 -38 -18 -122 -27 -185 -9 -63 -24 -140 -32 -171 -24 -91 -14
                                -104 30 -36 20 31 37 59 37 62 0 2 14 27 30 55 114 194 193 362 279 595 22 59
                                72 264 95 387 21 111 31 443 17 573 -24 240 -72 412 -188 680 -46 107 -136
                                283 -189 372 -24 40 -44 76 -44 80 0 5 -10 19 -21 33 -11 14 -44 61 -73 105
                                -73 111 -146 207 -225 294 -36 41 -76 88 -89 105 -28 39 -193 206 -203 206 -4
                                0 -17 -33 -29 -72z"/>
                                        <path
                                            d="M6293 17232 c-69 -60 -127 -96 -268 -167 -82 -41 -153 -79 -159 -84
                                -6 -4 -38 -23 -71 -41 -68 -36 -239 -198 -316 -299 -127 -165 -168 -366 -123
                                -596 26 -137 44 -218 59 -270 8 -27 19 -69 25 -93 7 -28 16 -42 25 -40 27 6
                                208 184 285 279 67 83 150 208 150 226 0 19 78 134 99 145 20 11 25 10 38 -7
                                9 -13 12 -30 8 -50 -4 -16 -10 -55 -15 -85 -14 -101 -110 -297 -207 -423 -25
                                -32 -43 -60 -41 -62 6 -6 59 23 98 54 19 15 50 36 68 45 51 26 212 193 261
                                271 24 39 54 86 67 105 90 139 129 324 129 610 0 154 -19 352 -39 410 -3 8
                                -10 34 -16 58 -6 23 -14 42 -18 42 -4 0 -21 -13 -39 -28z"/>
                                        <path
                                            d="M6785 15400 c-22 -4 -110 -11 -195 -14 -85 -4 -184 -14 -220 -22
                                -281 -64 -477 -130 -610 -206 -36 -20 -94 -53 -130 -72 -37 -19 -84 -49 -107
                                -68 -36 -30 -75 -59 -167 -126 -57 -41 -224 -203 -283 -274 -32 -38 -84 -100
                                -115 -136 -32 -37 -58 -70 -58 -75 0 -4 -31 -49 -69 -101 -38 -52 -82 -118
                                -96 -147 -15 -29 -37 -66 -48 -81 -31 -42 -13 -45 36 -5 106 87 217 166 268
                                192 19 10 43 25 54 35 74 67 442 247 580 284 291 76 440 94 486 58 44 -36 36
                                -41 -266 -180 -93 -43 -217 -108 -275 -144 -58 -36 -123 -75 -146 -86 -22 -11
                                -47 -28 -55 -38 -8 -9 -44 -36 -80 -60 -37 -23 -70 -48 -74 -54 -4 -6 -25 -22
                                -48 -37 -79 -50 -477 -455 -477 -486 0 -6 25 -16 185 -72 96 -35 152 -52 260
                                -80 28 -7 91 -25 140 -39 238 -70 274 -78 480 -113 169 -29 373 -21 540 23
                                128 33 366 138 450 199 28 20 68 47 90 62 115 75 310 247 386 340 30 37 75 90
                                101 119 26 29 55 68 64 86 9 18 25 44 36 58 44 58 89 133 132 218 25 50 66
                                122 91 161 25 38 45 71 45 74 0 5 96 160 135 218 62 92 130 177 211 266 46 50
                                80 94 74 98 -61 38 -537 159 -710 181 -30 3 -65 10 -76 15 -12 4 -102 11 -200
                                14 -99 4 -197 11 -219 16 -46 10 -65 10 -120 -1z"/>
                                        <path
                                            d="M2065 14190 c-207 -45 -451 -139 -575 -222 -19 -12 -55 -34 -80 -47
                                -74 -40 -152 -93 -196 -132 -23 -21 -59 -49 -81 -62 -22 -14 -87 -71 -144
                                -126 -99 -97 -103 -102 -85 -116 11 -8 27 -15 36 -15 8 0 24 -6 35 -13 11 -7
                                43 -22 70 -32 57 -21 247 -133 417 -246 204 -136 363 -207 598 -265 115 -29
                                456 -27 557 3 98 29 220 89 265 129 20 18 54 42 75 53 21 10 60 42 87 71 27
                                28 62 60 80 71 44 26 326 308 326 325 0 8 -6 14 -14 14 -8 0 -36 11 -63 24
                                -57 29 -248 88 -353 109 -167 35 -250 42 -495 43 -211 1 -250 3 -259 16 -16
                                26 0 45 64 77 62 32 170 59 320 81 121 17 384 6 590 -25 l45 -7 -33 21 c-18
                                12 -92 52 -165 89 -156 80 -359 149 -552 186 -110 22 -362 19 -470 -4z"/>
                                        <path
                                            d="M3920 13413 c-47 -43 -110 -98 -140 -123 -79 -64 -356 -338 -415
                                -410 -27 -34 -71 -85 -97 -114 -44 -49 -79 -107 -150 -249 -95 -192 -136 -484
                                -103 -737 34 -267 58 -367 128 -550 53 -139 106 -249 161 -335 25 -38 64 -106
                                87 -150 23 -44 61 -112 85 -151 24 -39 64 -120 89 -180 26 -60 53 -118 60
                                -130 15 -24 75 -198 75 -219 0 -30 21 -23 70 22 29 27 62 55 75 63 41 28 157
                                145 183 185 14 22 51 64 83 94 32 29 72 74 89 100 16 25 45 65 63 88 74 96
                                126 171 147 213 13 25 33 57 45 71 34 42 210 405 239 494 31 98 51 185 77 333
                                24 144 26 416 4 542 -9 47 -23 126 -32 175 -28 159 -85 339 -157 500 -13 28
                                -28 64 -35 80 -6 17 -29 64 -51 105 -21 41 -49 95 -61 120 -29 60 -34 35 -15
                                -70 23 -119 23 -676 0 -787 -46 -228 -118 -453 -144 -453 -4 0 -13 -13 -19
                                -29 -7 -15 -23 -34 -37 -42 -21 -11 -27 -10 -40 2 -12 13 -13 24 -5 60 18 78
                                35 329 36 514 0 227 -27 471 -72 650 -36 144 -117 395 -127 395 -7 0 -50 -35
                                -96 -77z"/>
                                        <path
                                            d="M5235 12921 c-18 -8 -17 -9 10 -16 145 -34 435 -169 468 -218 8 -12
                                34 -42 56 -66 66 -70 36 -105 -51 -60 -42 22 -153 63 -318 118 -98 33 -239 59
                                -357 65 -88 4 -106 -3 -79 -33 9 -10 16 -22 16 -27 0 -22 74 -196 132 -311
                                105 -209 192 -301 353 -379 148 -71 237 -88 455 -88 136 0 205 4 260 16 128
                                28 281 48 368 48 45 0 82 2 82 4 0 16 -137 287 -175 346 -104 161 -254 328
                                -360 404 -89 64 -260 145 -362 172 -85 22 -123 26 -288 30 -104 2 -199 0 -210
                                -5z"/>
                                        <path
                                            d="M7315 6633 c-77 -9 -236 -47 -314 -75 -386 -135 -752 -477 -960 -898
                                -67 -137 -130 -315 -116 -329 24 -22 52 8 85 91 239 604 759 1051 1340 1153
                                128 23 250 19 364 -9 92 -24 237 -81 341 -134 l50 -26 -35 -9 c-19 -6 -94 -29
                                -165 -53 -762 -250 -1411 -880 -1551 -1505 -55 -244 14 -534 163 -685 103
                                -104 271 -162 433 -149 280 22 557 121 783 282 163 115 357 330 478 528 98
                                161 215 457 258 656 72 335 38 551 -133 832 -26 43 -46 80 -44 82 15 16 481
                                75 589 75 203 0 586 -58 756 -115 105 -35 223 -90 223 -103 -1 -4 -39 -29 -85
                                -56 -325 -191 -696 -564 -975 -981 -133 -198 -308 -496 -505 -855 -379 -691
                                -544 -938 -790 -1186 -232 -233 -463 -363 -743 -419 -105 -21 -192 -17 -254
                                14 -99 48 -188 154 -188 225 0 14 18 61 40 103 27 51 38 83 34 97 -30 102
                                -108 206 -170 226 -88 29 -246 -81 -285 -197 -35 -106 19 -274 118 -370 55
                                -52 176 -122 248 -142 78 -22 252 -32 369 -21 652 64 1148 392 1646 1090 156
                                218 228 337 710 1170 356 616 553 894 820 1155 l102 100 51 -55 c113 -123 194
                                -282 204 -400 6 -76 -19 -212 -69 -370 -105 -334 -309 -550 -581 -616 -64 -16
                                -73 -16 -145 -1 -96 21 -134 21 -201 1 -59 -17 -107 -57 -116 -95 -9 -37 43
                                -95 98 -110 57 -15 108 -6 205 35 123 53 154 59 220 46 31 -7 78 -23 104 -37
                                48 -26 143 -115 179 -168 39 -58 88 -163 105 -226 49 -180 -9 -495 -140 -764
                                -138 -281 -310 -467 -531 -575 -142 -69 -204 -84 -360 -84 -126 -1 -132 0
                                -198 31 -117 56 -208 167 -243 298 -20 73 -17 209 5 297 22 84 73 192 134 283
                                47 70 189 219 265 277 53 41 62 58 39 76 -30 25 -253 -175 -365 -327 -116
                                -156 -163 -285 -163 -446 0 -179 50 -315 150 -416 107 -107 255 -160 451 -162
                                142 -1 244 15 380 59 306 98 590 313 772 582 248 367 260 742 32 1042 -103
                                137 -240 228 -449 300 l-80 27 45 12 c268 69 459 174 574 316 73 89 133 201
                                174 327 55 168 69 260 55 344 -14 80 -74 207 -136 290 -62 82 -191 203 -276
                                260 -39 26 -71 50 -71 55 0 4 42 28 93 52 50 24 100 53 110 65 18 20 18 21 -2
                                31 -11 6 -28 11 -38 11 -23 0 -129 -50 -206 -97 -55 -33 -62 -35 -96 -24 -343
                                110 -563 150 -931 172 -214 13 -156 18 -680 -60 l-124 -19 -43 29 c-105 73
                                -281 136 -458 164 -81 14 -301 18 -380 8z m846 -325 c88 -123 150 -312 150
                                -458 -1 -268 -133 -628 -355 -965 -220 -335 -466 -559 -737 -675 -387 -164
                                -726 -22 -795 335 -12 67 -13 97 -4 179 60 527 520 1069 1200 1415 175 89 458
                                209 497 210 7 1 27 -18 44 -41z"/>
                                        <path
                                            d="M11765 5174 c-102 -53 -164 -198 -121 -282 31 -60 103 -92 165 -73
                                44 13 114 78 141 131 24 47 26 129 5 170 -34 67 -119 91 -190 54z"/>
                                        <path
                                            d="M10999 3962 c-108 -114 -238 -254 -289 -312 -90 -102 -217 -265 -222
                                -285 -2 -5 6 -11 17 -13 21 -3 49 25 334 341 184 204 181 190 -29 -138 -182
                                -285 -250 -436 -250 -557 0 -125 59 -243 146 -289 69 -38 121 -44 191 -24 167
                                48 434 264 675 547 55 65 104 116 108 113 9 -6 158 149 355 369 221 247 369
                                360 488 373 54 6 87 -19 87 -67 0 -58 -125 -267 -420 -700 -169 -249 -395
                                -586 -414 -617 -6 -10 29 -13 161 -13 l168 0 110 142 c225 290 417 506 579
                                650 55 48 101 86 103 85 1 -2 -9 -37 -23 -78 -26 -77 -41 -198 -30 -242 18
                                -73 104 -126 203 -127 54 0 73 6 155 48 113 57 258 190 258 235 0 15 -5 27
                                -11 27 -6 0 -56 -41 -112 -91 -60 -53 -128 -103 -165 -121 -158 -78 -262 -27
                                -262 129 0 163 97 304 317 459 263 186 329 288 223 346 -68 38 -190 8 -279
                                -68 -57 -49 -131 -166 -175 -278 -37 -93 -40 -96 -144 -193 -59 -54 -158 -147
                                -220 -207 -61 -60 -114 -107 -116 -105 -2 2 22 51 55 109 122 216 179 382 182
                                525 2 69 -2 86 -23 125 -31 55 -93 100 -148 107 -58 8 -146 -25 -252 -95 -103
                                -67 -412 -373 -539 -532 -46 -58 -96 -110 -110 -116 -29 -13 -154 -140 -310
                                -316 -192 -217 -354 -335 -508 -369 -43 -10 -55 -10 -69 2 -21 17 -53 87 -54
                                115 0 30 103 229 186 359 39 61 181 281 315 490 267 414 289 449 289 459 0 3
                                -75 6 -167 5 l-168 0 -196 -207z m2385 126 c25 -40 -54 -139 -183 -227 -102
                                -70 -121 -79 -121 -59 0 23 115 190 161 235 73 70 120 87 143 51z"/>
                                        <path
                                            d="M5690 1325 l0 -765 70 0 70 0 0 98 0 98 73 -71 c43 -42 96 -82 130
                                -98 206 -100 447 -61 615 98 125 118 183 250 185 420 1 180 -47 300 -173 426
                                -120 121 -269 178 -428 164 -143 -12 -243 -57 -348 -157 l-54 -51 0 302 0 301
                                -70 0 -70 0 0 -765z m741 208 c82 -40 137 -88 183 -158 160 -240 75 -556 -181
                                -678 -64 -30 -75 -32 -178 -32 -103 0 -114 2 -177 32 -165 78 -258 228 -258
                                417 0 172 67 301 201 387 80 51 150 69 255 66 78 -2 100 -7 155 -34z"/>
                                        <path
                                            d="M11780 1875 l0 -205 -100 0 -100 0 0 -60 0 -59 98 -3 97 -3 3 -492 2
                                -493 65 0 65 0 0 495 0 495 115 0 115 0 0 60 0 60 -115 0 -115 0 0 205 0 205
                                -65 0 -65 0 0 -205z"/>
                                        <path
                                            d="M7630 1690 c-30 -6 -91 -28 -136 -50 -99 -48 -190 -140 -246 -246
                                -168 -319 -11 -736 315 -836 102 -31 264 -31 362 -1 82 26 172 82 232 144 39
                                41 113 153 113 171 0 8 -93 58 -107 58 -4 0 -25 -27 -46 -59 -95 -147 -231
                                -218 -402 -209 -186 10 -335 138 -380 329 -8 35 -15 76 -15 92 l0 27 496 0
                                497 0 -6 73 c-4 39 -13 94 -22 120 -54 177 -206 327 -379 373 -68 19 -208 25
                                -276 14z m293 -158 c115 -53 204 -160 231 -274 l6 -28 -410 0 c-354 0 -410 2
                                -410 15 0 24 47 122 81 170 39 54 119 111 191 137 84 30 224 21 311 -20z"/>
                                        <path
                                            d="M9114 1685 c-169 -37 -317 -153 -394 -310 -88 -178 -73 -419 36 -584
                                198 -297 600 -346 853 -102 l61 59 0 -94 0 -94 70 0 70 0 0 555 0 555 -70 0
                                -70 0 0 -99 0 -99 -68 68 c-133 133 -306 185 -488 145z m313 -155 c313 -155
                                343 -612 51 -800 -254 -164 -584 -27 -663 275 -59 230 71 472 295 547 42 14
                                77 17 152 15 86 -4 105 -8 165 -37z"/>
                                        <path
                                            d="M10243 1308 c4 -332 6 -370 26 -443 38 -142 107 -230 226 -286 102
                                -48 227 -60 350 -34 187 40 299 155 339 348 13 61 16 146 16 427 l0 350 -69 0
                                -70 0 -3 -387 c-3 -383 -3 -389 -27 -440 -27 -61 -93 -126 -159 -156 -38 -18
                                -66 -22 -147 -22 -126 0 -183 23 -253 100 -83 90 -85 103 -90 533 l-4 372 -70
                                0 -70 0 5 -362z"/>
                                        <path
                                            d="M12581 1178 c121 -271 222 -504 225 -518 3 -17 -27 -98 -100 -263
                                l-104 -238 74 3 75 3 328 753 329 753 -75 -3 -75 -3 -181 -417 c-99 -230 -184
                                -418 -187 -418 -4 0 -91 189 -195 420 l-188 420 -72 0 -73 0 219 -492z"/>
                                    </g>
                                </svg>
                                <!-- SVG Logo End-->
                                <p style="margin-bottom: 0;margin-top: 0px; font-size: 8px;padding: 0px 10%; ">{{  generalSettings()->address}}</p>
                                <p style="margin-bottom: 0;margin-top: 5px; font-size: 10px; color:#000;">Customer: {{ $bookingSystem->customer_name}}</p>
                                <p style="margin-bottom: 0;margin-top: 1px; font-size: 10px; color:#000;">Phone:{{ $bookingSystem->customer_phone}}</p>
                                <p style="margin-bottom: 0;margin-top: 1px;font-size: 10px; color:#000;">Date: {{ date('F j, Y',strtotime($bookingSystem->booking_date)) }}</p>
                                <p style="margin-bottom: 0;margin-top: 1px ; font-size: 10px; color:#000;">Address:  {{ $bookingSystem->customer_address }}
                            </p>
                            <p style="margin-bottom: 0;margin-top: 1px; font-size: 10px; color:#000000;">Book Type: {{$bookingSystem->booking_type  }}</p>
                                {{--  <p style="margin-bottom: 0;margin-top: 5px;font-size: 8px;">VAT No: 65478921345</p>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="invoice-info" style="font-size: 8px;">
                        <div>
                        </div>
                    </div>
                    <div class="product-info">
                        <table style="width: 100%;border-bottom: 1px dashed #000;">
                            <thead>
                                <tr>
                                    <th style="text-align: start ; border-top: 1px dashed #000;border-bottom: 1px dashed #000;">
                                        #</th>
                                    <th
                                        style="max-width: 100px;text-align: start ; border-top: 1px dashed #000;border-bottom: 1px dashed #000;">
                                        Items</th>

                                    <th style="text-align: end;border-top: 1px dashed #000;border-bottom: 1px dashed #000;">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td style="max-width: 100px;">{{$bookingSystem->service_name  }}</td>

                                    <td style="text-align: end;">{{$bookingSystem->total_amount  }}<span>&#2547;</span></td>

                            </tbody>
                        </table>
                        <table style="text-align: end;margin-left: auto">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>:</td>
                                    <td>{{$bookingSystem->total_amount  }}<span>&#2547;</span></td>
                                </tr>


                                <tr>
                                    <td>Amount Paid</td>
                                    <td>:</td>
                                    <td>{{$bookingSystem->paid  }}<span>&#2547;</span></td>
                                </tr>
                                <tr>
                                    <td>Amount Due</td>
                                    <td>:</td>
                                    <td>{{$bookingSystem->due  }}<span>&#2547;</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pos-footer" style="border-top: 0.5px dashed #000;margin-top: 10px;margin-bottom: 10px;">
                        <h1 style="text-align: center; font-size: 11px;padding-top:8px;margin-bottom: 0;">Thanks For Visiting
                            Us</h1>
                    </div>
                </div>
            </div>
        </section>
                <center style="margin-bottom:34px !important; margin-top:14px!important;">
                    <div class="row no-print">
                        <div class="col-md-12">
                            <div class="col-md-2 col-md-offset-5 col-xs-4 col-xs-offset-4 form-group">
                                <button type="button" id="print" title="Print" class="btn btn-block btn-success btn-xs">Print</button>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
    </div>
</div>
@section('admin_js')
    <script>
     $(document).ready(function() {
        $(document).on('click','#print',function(e){
            $("#demo").printThis({
                pageTitle: "",
                header: null,
                footer: null,
            });

        e.preventDefault()
        })

     })
    </script>
@endsection
@endsection

