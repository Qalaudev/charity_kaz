import { createRouter, createWebHistory } from 'vue-router';
import ProductList from '../components/ProductList.vue';
import EditProduct from '../components/EditProduct.vue';
import CreateProduct from '../components/CreateProduct.vue';
import HomePage from '../components/HomePage.vue';
import Profile from "../components/Profile.vue";
import CharityGroup from "../components/CharityGroup.vue";
import GroupDetails from "../components/GroupDetails.vue";
import GetHelp from "../components/GetHelp.vue";
import MyCard from "../components/MyCard.vue";
import PsichologyAi from "../components/PsichologyAi.vue";
import GiveHelp from "../components/GiveHelp.vue";
import ContactForm from '../components/ContactForm.vue';
import CharityHelp from "../components/design/CharityHelp.vue";
import VolunteerService from '../components/design/VolunteerService.vue';
import Donate from '../components/design/Donate.vue';
import notFound from '../components/design/notFound.vue';
import AboutUsSection from '../components/design/AboutUsSection.vue';
import AboutUs from '../components/design/AboutUs.vue';
import FAQ from '../components/design/FAQ.vue';
import CharityPayment from "../components/CharityPayment.vue";
import CharityPaymentForm from "../components/CharityPaymentForm.vue";

const routes = [
    {
        path: '/',
        component: ProductList,
    },
    {
        path: '/products/create',
        component: CreateProduct,
    },
    {
        path: '/products/:id/edit',
        component: EditProduct,
    },
    {
        path: '/homepage',
        component: HomePage,
    },
    {
        path: '/profile/user',
        component: Profile,
    },
    {
        path:'/create/group',
        component: CharityGroup
    },
    {
        path: '/group/:id',
        component: GroupDetails
    },
    {
        path: '/help',
        component: GetHelp
    },
    {
        path: '/my-card',
        component: MyCard
    },
    {
        path: '/ai',
        component: PsichologyAi
    },
    {
        path: '/give-help',
        component:GiveHelp
    },
    {
        path: '/contact-us',
        component:ContactForm
    }
    ,
    {
        path: '/charity-help',
        component:CharityHelp
    }
    ,
    {
        path: '/volunteer-service',
        component:VolunteerService
    } ,
    {
        path: '/donate',
        component:Donate
    } ,
    {
        path: '/not-found',
        component:notFound
    },
    {
        path: '/about-us-section',
        component:AboutUsSection
    },
    {
        path: '/about-us',
        component:AboutUs
    },
    {
        path: '/faq',
        component:FAQ
    },
    {
        path: '/making-donation',
        component: CharityPayment
    },
    {
        path: '/making-donation-form',
        component: CharityPaymentForm
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
