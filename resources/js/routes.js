const Home = () => import('./compoments/Home.vue')
const Contacto = () => import('./compoments/Contacto.vue')

//importamos los componentes para el blog

const Mostrar = () => import('./compoments/blog/Mostrar.vue')
const Crear = () => import('./compoments/blog/Crear.vue')
const Editar = () => import('./compoments/blog/Editar.vue')

const Login = () => import('./compoments/Login.vue')
const Register = () => import('./compoments/Register.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'mostrarBlogs',
        path: '/blogs',
        component: Mostrar
    },
    {
        name: 'crearBlog',
        path: '/crear',
        component: Crear
    },
    {
        name: 'editarBlog',
        path: '/editar/:id',
        component: Editar
    },
    {
        name: 'contacto',
        path: '/contacto',
        component: Contacto
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
]