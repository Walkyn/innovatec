<!-- navbar -->
<div class="py-2 px-6 bg-gray-800 flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
    <button type="button" class="text-lg text-gray-200 font-semibold sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>

    <ul class="ml-auto flex items-center">
        <button id="fullscreen-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-800 hover:text-white rounded-full"
                viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;">
                <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path>
            </svg>
        </button>
        <script>
            const fullscreenButton = document.getElementById('fullscreen-button');

            fullscreenButton.addEventListener('click', toggleFullscreen);

            function toggleFullscreen() {
                if (document.fullscreenElement) {
                    // If already in fullscreen, exit fullscreen
                    document.exitFullscreen();
                } else {
                    // If not in fullscreen, request fullscreen
                    document.documentElement.requestFullscreen();
                }
            }
        </script>

        <li class="dropdown ml-3">
            <button type="button" class="dropdown-toggle flex items-center">
                <div class="flex-shrink-0 w-10 h-10 relative">
                    <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                        <img class="w-8 h-8 rounded-full"
                            src="https://laravelui.spruko.com/tailwind/ynex/build/assets/images/faces/9.jpg"
                            alt="" />
                        <div
                            class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping">
                        </div>
                        <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full">
                        </div>
                    </div>
                </div>
                <div class="p-2 md:block text-left">
                    <h2 class="text-sm font-semibold text-gray-200">Brayan Capa Medina</h2>
                    <p class="text-xs text-gray-300">Cliente</p>
                </div>
            </button>
            <ul
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                <li>
                    <a href="#"
                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profile</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Settings</a>
                </li>
                <li>
                    <form method="POST" action="">
                        <a role="menuitem"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end navbar -->
