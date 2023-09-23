let routes= [];

import dashboard from "./vue-routes-dashboard";
import customer from "./vue-routes-customers";

routes = routes.concat(dashboard);
routes = routes.concat(customer);
export default routes;
