<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>طوفان الأقصى</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="text-white flex items-center justify-center bg-cover bg-background1">
        <div
            class="m-4 shadow-2xl w-80 flex flex-col nowrap items-center justify-around border border-orange-300 backdrop-blur-md">
            <!-- header القسم الخاص بالرأس -->
            <div class="h-6 bg-blue-600 w-full flex justify-between px-2">
                <svg class="h-6 w-6 text-yellow-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>

                <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <!-- لعرض الصفحة الرئيسية  -->
            <div class="flex flex-col justify-center px-2 w-full">
                <div class="flex justify-center">
                    <img class="w-32 h-32 rounded-full" src="./images/persnal1.jpg" alt="" />
                </div>
                <div class="flex flex-col justify-center text-center">
                    <h2 class="text-xl">إزاحة للستار وكشف للحقائف</h2>
                    <a class="text-sm text-center" href="#">الصفحة الرئيسية</a>
                </div>
                <div class="px-2 text-center justify-center flex">
                    <ul>
                        <li class="w-52 mt-2 h-8 p-2 items-center border border-orange-300 backdrop-blur-md text-xs">
                            <a href="{{route('borhan.train')}}">بوت البرهان الذكي </a>
                        </li>
                        <li class="w-52 mt-3 h-8 p-2 items-center border border-orange-300 backdrop-blur-md text-xs">
                            <a href="">سلسلة الفيديوهات </a>
                        </li>
                        <li class="w-52 mt-3 h-8 p-2 items-center border border-orange-300 backdrop-blur-md text-xs">
                            <a href="">المكتبة للكتب العلمية </a>
                        </li>
                        <li class="w-52 mt-3 h-8 p-2 items-center border border-orange-300 backdrop-blur-md text-xs">
                            <a href="">القنوات </a>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-around m-2">
                    <!-- Whatsapp -->
                    <a href="">
                        <span class="[&>svg]:h-5 [&>svg]:w-5">
                            <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                        </span>
                    </a>
                    <a href="">
                        <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="">
                        <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- لعرض التعليقات  -->
            <div class="w-full rounded-lg m-2 flex flex-col items-center justify-center">
                <div class="bg-blue-600 transition delay-150 duration-300 ease-in-out p-2 rounded-lg">
                    <h2>تقييم المتابعين</h2>
                </div>
                <div class="bg-white mx-8 min-w-72 rounded-lg text-black">
                    <ul>
                        <li
                            class="flex flex-row-reverse text-xs p-2 space-between text-wrap border mx-2 border-current">
                            <img class="w-8 h-8 rounded-full" src="./images/R.png" alt="" />
                            <p class="px-2">امجد زيود</p>
                            <p>
                                مشكورين من افضل التطبيقات استفدنا الكثير والله من الوعي
                                والمعرفة كتب الله اجركم
                            </p>
                        </li>
                        <li
                            class="flex flex-row-reverse text-xs p-2 space-between text-wrap border mx-2 border-current">
                            <img class="w-8 h-8 rounded-full" src="./images/R.png" alt="" />
                            <p class="px-2">امجد زيود</p>
                            <p>
                                مشكورين من افضل التطبيقات استفدنا الكثير والله من الوعي
                                والمعرفة كتب الله اجركم
                            </p>
                        </li>
                    </ul>
                    <div class="text-xs text-blue-600 flex justify-between p-2">
                        <a href="#">عرض المزيد...</a>
                        <button class="addCommit" href="#">اضافة تعليق+</button>
                    </div>
                    <!-- <div class="hide">
              <textarea class="resize rounded-md"></textarea>
              <button>إضافة</button>
            </div> -->
                </div>
            </div>
        </div>
    </div>
    <script>
        tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: "#da373d",
            },
            backgroundImage: {
              background1: "url('./images/bg.png')",
              commitHeader: "url('./images/Brain1.png')",
            },
          },
        },
      };
    </script>
</body>

</html>