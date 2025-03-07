<div class="fixed top-0 py-24 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    id="eventModal">
    <!-- Fondo oscuro -->
    <div class="fixed inset-0 bg-gray-400/50 backdrop-blur modal-close-btn"></div>

    <!-- Contenedor del modal -->
    <div class="relative w-full max-w-[700px] mx-auto bg-white rounded-3xl shadow-lg dark:bg-gray-900 p-6 lg:p-11">
        <!-- Botón de cierre -->
        <button
            class="modal-close-btn transition-color absolute right-5 top-5 z-999 flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300 sm:h-11 sm:w-11">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                    fill="" />
            </svg>
        </button>

        <!-- Contenido del modal -->
        <div class="flex flex-col px-2 overflow-y-auto modal-content custom-scrollbar">
            <div class="modal-header">
                <h5 class="mb-2 font-semibold text-gray-800 modal-title text-theme-xl dark:text-white/90 lg:text-2xl"
                    id="eventModalLabel">
                    Add / Edit Event
                </h5>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Plan your next big moment: schedule or edit an event to stay on track
                </p>
            </div>
            <div class="mt-8 modal-body">
                <div>
                    <div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Event Title
                            </label>
                            <input id="event-title" type="text"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                        </div>
                    </div>
                    <div class="mt-6">
                        <div>
                            <label class="block mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">
                                Event Color
                            </label>
                        </div>
                        <div class="flex flex-wrap items-center gap-4 sm:gap-5">
                            <div class="n-chk">
                                <div class="form-check form-check-primary form-check-inline">
                                    <label
                                        class="flex items-center text-sm text-gray-700 form-check-label dark:text-gray-400"
                                        for="modalDanger">
                                        <span class="relative">
                                            <input class="sr-only form-check-input" type="radio" name="event-level"
                                                value="Danger" id="modalDanger" />
                                            <span
                                                class="flex items-center justify-center w-5 h-5 mr-2 border border-gray-300 rounded-full box dark:border-gray-700">
                                                <span class="w-2 h-2 bg-white rounded-full dark:bg-transparent"></span>
                                            </span>
                                        </span>
                                        Danger
                                    </label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <label
                                        class="flex items-center text-sm text-gray-700 form-check-label dark:text-gray-400"
                                        for="modalSuccess">
                                        <span class="relative">
                                            <input class="sr-only form-check-input" type="radio" name="event-level"
                                                value="Success" id="modalSuccess" />
                                            <span
                                                class="flex items-center justify-center w-5 h-5 mr-2 border border-gray-300 rounded-full box dark:border-gray-700">
                                                <span class="w-2 h-2 bg-white rounded-full dark:bg-transparent"></span>
                                            </span>
                                        </span>
                                        Success
                                    </label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-success form-check-inline">
                                    <label
                                        class="flex items-center text-sm text-gray-700 form-check-label dark:text-gray-400"
                                        for="modalPrimary">
                                        <span class="relative">
                                            <input class="sr-only form-check-input" type="radio" name="event-level"
                                                value="Primary" id="modalPrimary" />
                                            <span
                                                class="flex items-center justify-center w-5 h-5 mr-2 border border-gray-300 rounded-full box dark:border-gray-700">
                                                <span class="w-2 h-2 bg-white rounded-full dark:bg-transparent"></span>
                                            </span>
                                        </span>
                                        Primary
                                    </label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-danger form-check-inline">
                                    <label
                                        class="flex items-center text-sm text-gray-700 form-check-label dark:text-gray-400"
                                        for="modalWarning">
                                        <span class="relative">
                                            <input class="sr-only form-check-input" type="radio" name="event-level"
                                                value="Warning" id="modalWarning" />
                                            <span
                                                class="flex items-center justify-center w-5 h-5 mr-2 border border-gray-300 rounded-full box dark:border-gray-700">
                                                <span class="w-2 h-2 bg-white rounded-full dark:bg-transparent"></span>
                                            </span>
                                        </span>
                                        Warning
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Enter Start Date
                            </label>
                            <div class="relative">
                                <input id="event-start-date" type="date"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                    onclick="this.showPicker()" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Enter End Date
                            </label>
                            <div class="relative">
                                <input id="event-end-date" type="date"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                    onclick="this.showPicker()" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6 modal-footer sm:justify-end">
                <button type="button"
                    class="btn modal-close-btn bg-danger-subtle text-danger flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Close
                </button>
                <button type="button"
                    class="btn btn-success btn-update-event flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                    Update changes
                </button>
                <button type="button"
                    class="btn btn-primary btn-add-event flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                    Add Event
                </button>
            </div>
        </div>
    </div>
</div>
