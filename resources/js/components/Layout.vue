<template>
  <div class="min-h-full">
    <Disclosure as="nav" class="border-b border-gray-200 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <div class="flex shrink-0 items-center">
              <img class="block h-8 w-auto lg:hidden"
                   src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                   alt="Your Company"/>
              <img class="hidden h-8 w-auto lg:block"
                   src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                   alt="Your Company"/>
            </div>
            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
              <RouterLink v-for="item in navigation"
                          :key="item.name"
                          :to="item.to"
                          :class="[ $route.name === item.to.name  ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium']"
                          :aria-current="$route.name === item.to.name ? 'page' : undefined">{{ item.name }}
              </RouterLink>
            </div>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <!-- Profile dropdown -->
            <Menu as="div" class="relative ml-3">
              <div>
                <MenuButton @click="open = !open"
                            class="cursor-pointer relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  <span class="absolute -inset-1.5"/>
                  <span class="sr-only">Open user menu</span>
                  <img class="size-8 rounded-full" :src="user.imageUrl" alt=""/>
                </MenuButton>
              </div>
              <transition v-show="open" enter-active-class="transition ease-out duration-200"
                          enter-from-class="transform opacity-0 scale-95"
                          enter-to-class="transform opacity-100 scale-100"
                          leave-active-class="transition ease-in duration-75"
                          leave-from-class="transform opacity-100 scale-100"
                          leave-to-class="transform opacity-0 scale-95">
                <MenuItems
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none">
                  <MenuItem>
                    <button @click="logout" :class="['cursor-pointer block px-4 py-2 text-sm text-gray-700']">Sign Out
                    </button>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>

      <DisclosurePanel class="sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
          <RouterLink v-for="item in navigation"
                      :key="item.name" as="a"
                      :to="item.to"
                      :class="[$route.name === item.to.name ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800', 'block border-l-4 py-2 pl-3 pr-4 text-base font-medium']"
                      :aria-current="$route.name === item.to.name ? 'page' : undefined">{{ item.name }}
          </RouterLink>
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
          <div class="flex items-center px-4">
            <div class="shrink-0">
              <img class="size-10 rounded-full" :src="user.imageUrl" alt=""/>
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
              <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
            </div>
          </div>
          <div class="mt-3 space-y-1">
            <DisclosureButton @click="logout"
                              class="cursor-pointer block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">
              Sign Out
            </DisclosureButton>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>

    <main class="mt-10">
      <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
        <div class="rounded-lg bg-white px-5 py-6 shadow sm:px-6">
          <RouterView/>
        </div>
      </div>
    </main>

  </div>
</template>

<script>
import {useAuthStore} from './../auth';
import {useRouter} from 'vue-router';
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {Bars3Icon, XMarkIcon} from '@heroicons/vue/24/outline'

export default {
  name: 'Layout',
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Bars3Icon,
    XMarkIcon
  },
  data() {
    return {
      open: false,
      user: {
        name: 'Tom Cook',
        email: 'tom@example.com',
        imageUrl: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
      },
      navigation: [
        {name: 'Machines', to: {name: 'machines.index'}},
      ],
    };
  },
  methods: {
    logout() {
      const authStore = useAuthStore();
      const router = this.$router;
      authStore.router = router;
      authStore.logout();
    },
  },
};
</script>
