import { Stack } from "react-bootstrap";
import MenuLateral from "../MenuLateral";
import classes from "./MenuPrincipal.module.css";


export default function MenuPrincipal() {
    return (
        <div>
            <div className={classes.menu_lateral}>
            
            <MenuLateral></MenuLateral>
            </div>
        </div>
    )
}