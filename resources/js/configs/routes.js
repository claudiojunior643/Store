import LoginForm from '../components/forms/LoginForm/index.vue'
import UserForm from '../components/forms/UserForm/index.vue'
import EmptyLayout from '../layouts/Empty';
import UserLayout from '../layouts/Main/User';
import MainLayout from '../layouts/Main';
import HomePage from '../pages/Home';
import ContractsPage from '../pages/Contracts';

const routes = [

  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '/',
        component: HomePage
      },
    ],
  },
  {
    path: '/auth',
    component: EmptyLayout,
    children: [
      {
        path: '/login',
        component: LoginForm
      },
      {
        path: '/user',
        component: UserLayout,
        children: [
          {
            path: '/user',
            component: UserForm
          },
        ],
      },
    ],
  },
  {
    path: '/contracts',
    component: MainLayout,
    children: [
      {
        path: '/contracts',
        component: ContractsPage
      },
    ],
  },

];

export default routes;
