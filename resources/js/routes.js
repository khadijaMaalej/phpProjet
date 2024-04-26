import Accueil from './components/Accueil.vue';
import Menu from './components/Menu.vue'
import Addarticle from './components/articles/Addarticle.vue'
import Viewarticles from './components/articles/Viewarticles.vue'
import Editarticle from "./components/articles/Editarticle.vue"
import Addfacture from "./components/facture/Addfacture.vue"
import Viewfacture from "./components/facture/Viewfacture.vue"
import Editfacture from "./components/facture/Editfacture.vue"
import Adddepot from "./components/depot/Adddepot.vue"
import Viewdepot from "./components/depot/Viewdepot.vue"
import Editdepot from "./components/depot/Editdepot.vue"
import Viewfournisseur from "./components/fournisseur/Viewfournisseur.vue"
import Addfournisseur from "./components/fournisseur/Addfournisseur.vue"
import Editfournisseur from "./components/fournisseur/Editfournisseur.vue"
import Viewcommande from "./components/commande/Viewcommande.vue"
import Addcommande from "./components/commande/Addcommande.vue"
import Editcommande from "./components/commande/Editcommande.vue"
import Login from './components/authentification/login.vue'
import Register from './components/authentification/register.vue'
import Dashboard from './components/admin/dashboard.vue'


export const routes = [
    {
        name: 'accueil',
        path: '/',
        component: Accueil
        },
{
    path:'/menu',
    name:'menu',
    component:Menu
    },
    {
        name:"Addarticle",
        path:"/addarticle",
        component:Addarticle
        },
        {
            name:"Viewarticles",
            path:"/listart",
            component:Viewarticles,
          //  meta:{isAuth:true}
            },
            {

                name:"editarticle",
                path:"/editarticle/:id",
                component:Editarticle
                },
                {
                    name:"Addfacture",
                    path:"/addfact",
                    component:Addfacture
                },
                {
                    name:"Viewfacture",
                    path:"/listfact",
                    component:Viewfacture,
                   // meta:{isAuth:true}
                    },
                    {
        
                        name:"editfacture",
                        path:"/editfacture/:id",
                        component:Editfacture
                        },
                        {
                            name:"Adddepot",
                            path:"/adddepot",
                            component:Adddepot,
                          //  meta:{isAuth:true}
                        },
                        {
                            name:"Viewdepot",
                            path:"/listdepot",
                            component:Viewdepot,
                          //  meta:{isAuth:true}
                        },
                        {
                            name:"editdepot",
                            path:"/editdepot/:id",
                            component:Editdepot
                        },
                        {
                            name:"Viewfournisseur",
                            path:"/listfournisseur",
                            component:Viewfournisseur
                        },
                        {
                            path: '/addfournisseur',
                              name: 'Addfournisseur',
    component: Addfournisseur,
                        },
                        {
                            path: '/editfournisseur/:id', // Use a dynamic segment to capture the ID
                            name: 'Editfournisseur',
                            component: Editfournisseur,
                        },

                        {
                            name:"Viewcommande",
                            path:"/listcommande",
                            component:Viewcommande
                        },
                        {
                            path: '/addcommande',
                              name: 'Addcommande',
    component: Addcommande,
                        },
                        {
                            
                                name: 'editcommande',
                                path: '/editcommande/:id',
                                component: Editcommande
                            
                            
                        },
                        {
                            name: "login",
                            path: "/login",
                            component: Login,
                            },
                            {
                            name: "register",
                            path: "/register",
                            component: Register,
                            },
                            {
                            
                            name: "dashboard",
                            path: '/dashboard',
                            component: Dashboard,
                            
                            }
];