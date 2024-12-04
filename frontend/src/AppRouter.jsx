import { Routes, Route } from "react-router-dom";
import Login from "./Pages/Login.jsx";
import SignUp from "./Pages/SignUp.jsx";
import Home from "./Pages/Home.jsx";
import Shop from "./Pages/Shop.jsx";
import SellBook from "./Pages/SellBook.jsx";

const AppRouter = () => {
    return (
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/Login" element={<Login />} />
            <Route path="/SignUp" element={<SignUp />} />
            <Route path="/Home" element={<Home />} />
            <Route path="/SellBook" element={<SellBook />} />
            <Route path="/Shop" element={<Shop />} />
        </Routes>
    )
}

export default AppRouter;