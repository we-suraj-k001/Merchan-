let routes= [];

import dashboard from "./vue-routes-dashboard";
import customer from "./vue-routes-customers";
import channel from "./vue-routes-channels";

routes = routes.concat(dashboard);
routes = routes.concat(customer);
routes = routes.concat(channel);
export default routes;
