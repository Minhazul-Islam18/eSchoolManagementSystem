  <footer class="footer card rounded-none mt-auto">
      <div class="h-16 flex items-center px-8 rounded-none">
          <div class="flex md:justify-between justify-center w-full gap-4">
              <div>
                  {{ \carbon\Carbon::now()->format('Y') }}
                  © {{ config('app.name') }}
              </div>
              <div class="md:flex hidden gap-4 item-center md:justify-end">
                  <a href="javascript: void(0);"
                      class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">About</a>
                  <a href="javascript: void(0);"
                      class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Help</a>
                  <a href="javascript: void(0);"
                      class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Contact
                      Us</a>
              </div>
          </div>
      </div>
  </footer>
