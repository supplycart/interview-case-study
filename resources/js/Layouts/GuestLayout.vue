<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-w-[1150px] bg-white h-full">
        <!-- First Navigation Bar -->
        <div  :style="{ transform: `translateY(${firstNavBarOffset}px)` }"
        class="flex items-center bg-[#F7F7F7] h-[40px] py-2 fixed z-50 w-full justify-end transition-margin duration-300">
            
            <Link class="h-[30px] p-4 pt-1 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer hidden md:block text-[13px]">
                MUJI Membership
            </Link>
            

            <Link class="h-[30px] p-4 pt-1 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[13px]">
                Store Locater
            </Link>

            <Link class="h-[30px] p-4 pt-1 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[13px]">
                Support Pages
            </Link>

            <div class="flex">
                <div class="h-[30px] p-4 pt-1">
                    <div class="flex justify-center">
                        <img src="/images/flags/UK.png" alt="" class="w-5 h-5 rounded-full mx-2">
                        <div class="text-[13px] h-[30px] rounded-sm hover:text-[#972A3E] cursur-pointer">UK | en</div>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Second Navigation Bar -->
        <div :style="{ transform: `translateY(${secondNavBarOffset}px)` }"
        class="bg-white fixed z-50 w-screen h-[68px] mt-[40px] border-b border-gray-300 items-center py-2 justify-between transition-margin duration-300">
            <div class="max-w-[1500px] lg:w-[75vw] md:w-full mx-auto">
                <div class="flex ">
                    <div class="flex items-center justify-between px-6 lg:hidden">
                        <MenuIcon v-if="!showMenu"
                        @click="showMenu = true"
                        fillColor="gray-700" :size="38" class="mr-0.5 cursor-pointer" 
                        :class="[showMenu ? 'animate__animated animate__fadeOut animate-slower' : 'animate__animated animate__fadeIn animate-slower']"/>
                        
                        <CloseIcon v-if="showMenu"
                        @click="showMenu = false"
                        fillColor="gray-700" :size="38" class="mr-0.5 cursor-pointer" 
                        :class="[showMenu ? 'animate__animated animate__fadeIn animate-slower' : 'animate__animated animate__fadeOut animate-slower']"/>
                    </div>

                    <div class="flex">
                        <Link class="h-[60px] pt-2 rounded-sm cursor-pointer text-[30px]">
                            <img width="200" src="/images/logo/Logo.png" alt="">
                        </Link>
                    </div>

                    <div class="flex grow items-center h-[40px] p-6 hidden md:flex">
                        <input class="block w-full border-[1px] border-gray-300 rounded-sm text-sm focus:border-gray-300 focus:ring-0" type="text" placeholder="Search MUJI Products">
                    </div>

                    <div class="flex items-center justify-end pr-6">
                        <Link class="h-[60px] p-4 pt-4 rounded-sm cursor-pointer">
                            <img src="https://img.muji.eu/img/icn/moa/ACCOUNT_thick.svg" alt="" class="w-6 h-6">
                        </Link>

                        <Link class="h-[60px] p-4 pt-4.5 rounded-sm cursor-pointer">
                            <img src="https://img.muji.eu/img/icn/moa/WISHLIST_thick.svg" alt="" class="w-6 h-6">
                        </Link>

                        <Link class="h-[60px] p-4 pt-4 rounded-sm cursor-pointer">
                            <img src="https://img.muji.eu/IMG/ICN/MOA/CART_thick.svg" alt="" class="w-6 h-6">
                        </Link> 
                    </div>               
                </div>
            </div>
        </div>

        <!-- Third Navigation Bar -->
        <div :style="{ marginTop: thirdNavBarMargin }"
        class="bg-white fixed z-50 w-screen h-[60px] transition-margin duration-300 border-b border-gray-300 items-center hidden lg:flex">
            <div class="max-w-[1500px] w-[75vw] mx-auto">
                <div class="flex justify-between">
                    <Link class="h-[30px] pr-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Furniture
                    </Link>
                        
                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Homeware
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Women
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Men
                    </Link>
                        
                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Kids
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Stationary
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Beauty
                    </Link>
                        
                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Travel
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Food
                    </Link>                

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Sale
                    </Link>

                    <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
                        Sustainability
                    </Link>
                </div>
            </div>
            
        </div>

        <main class="flex justify-center w-screen">
            <div class="max-w-[1500px] lg:w-[75vw] md:w-screen mx-auto">
                <div class="pt-[168px]"></div>
            </div>
        </main>
        
        <div class="flex my-[125px] w-full justify-center items-center mx-auto">
            <div
                class="w-[450px] p-12 bg-white border-[1px] border-gray-300 rounded-lg"
            >
                <slot />

                
            </div>
        </div>
        

        <!-- Footer -->
        <footer class="bg-white mt-4 w-screen justify-center">
           

            <div class="flex bg-white max-w-[1500px] lg:w-[75vw] md:w-full mx-auto">
                <Link class="pt-2 rounded-sm cursor-pointer text-[30px] md:pl-6">
                    <img width="150" src="/images/logo/Logo.png" alt="">
                </Link>
            </div>

            <div class="flex bg-gray-100 justify-center w-screen mt-2">
                <div class="grid grid-cols-1 grid-cols-4 gap-4 max-w-[1000px] w-[80vw]">
                    <ul class="flex-grow w-auto">
                        <li class="text-gray-700 underline text-[20px]">Shopping with MUJI</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Size Chart</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Store Locator</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Interior Advisor Service</li>
                    </ul>

                    <ul class="flex-grow w-auto">
                        <li class="text-gray-700 underline text-[20px]">Help</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Delivery</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Returns & Refund</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Contact Us</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Data Access Request</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Unsubscribe from MUJIMail</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Careers at MUJI</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Gift Card T&Cs</li>
                    </ul>

                    <ul class="flex-grow w-auto">
                        <li class="text-gray-700 underline text-[20px]">About Us</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">About Us</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Privacy Policy</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Terms & Conditions</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Cookies Policy</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Recycling</li>
                    </ul>

                    <ul class="flex-grow w-auto">
                        <li class="text-gray-700 underline text-[20px]">More About Us</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Data Transfer Agreement</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Sustainability</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Meet Our Materials</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Press</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Events Policy</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Modern Slavery Statement</li>
                        <li class="text-gray-900 hover:text-[#972A3E] hover:underline cursor-pointer">Tax Strategy</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
  data() {
    return {
      firstNavBarOffset: 0,
      secondNavBarOffset: 0,
      thirdNavBarMargin: '108px',
      prevScrollPos: 0,
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      const currentScrollPos = window.pageYOffset;

      if (currentScrollPos > this.prevScrollPos) {
        // Scrolling down, slide the first two navigation bars out of the screen
        this.firstNavBarOffset = -40; // Adjust the value as needed
        this.secondNavBarOffset = -108; // Adjust the value as needed
        this.thirdNavBarMargin = '0px';
      } else {
        // Scrolling up, bring the first two navigation bars back into view
        this.firstNavBarOffset = 0;
        this.secondNavBarOffset = 0;
        this.thirdNavBarMargin = '108px';
      }

      this.prevScrollPos = currentScrollPos;
    },
  },
};
</script>