<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import MapMarkerOutlineIcon from 'vue-material-design-icons/MapMarkerOutline.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>

    <div class="min-w-[1150px] bg-gray-100 h-full">

        <!-- First Navigation Bar -->
        <div class="flex items-center bg-[#F7F7F7] h-[40px] py-2 fixed z-50 w-full justify-end">
            
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
                        <img src="https://vue.placeholder.com/20x20" alt="" class="w-5 h-5 rounded-full mx-2">
                        <div class="text-[13px] h-[30px] rounded-sm hover:text-[#972A3E] cursur-pointer">UK | en</div>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Second Navigation Bar -->
        <div class="flex items-center bg-white h-[68px] py-2 fixed z-50 w-full mt-[40px] justify-between border-b border-gray-300">
            <div class="flex p-8">
                <Link class="h-[60px] pt-2 rounded-sm cursor-pointer text-[30px]">
                     MUJI 無印良品
                </Link>
            </div>

            <div class="flex grow items-center h-[40px] p-6 hidden md:flex">
                <input class="block w-full border-[1px] border-gray-300 rounded-sm text-sm focus:border-gray-300 focus:ring-0" type="text" placeholder="Search MUJI Products">
            </div>

            <div class="flex items-center p-4 justify-end">
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

        <!-- Third Navigation Bar -->
        <div class="flex items-center bg-white h-[60px] p-4 py-2 fixed z-50 w-full mt-[108px] border-b border-gray-300 justify-between hidden lg:flex">
            <Link class="h-[30px] p-4 pt-1 text-gray-900 rounded-sm hover:text-[#972A3E] hover:underline cursur-pointer text-[17px]">
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
        
        <main class="max-w-[1500px] mx-auto">
            <div class="pt-[148px]"></div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-100 mt-4">
            <div class="flex bg-white w-full">
                <Link class="px-8 pt-2 rounded-sm cursor-pointer text-[30px]">
                     MUJI 無印良品
                </Link>
            </div>

            <div class="flex justify-center w-screen">
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
