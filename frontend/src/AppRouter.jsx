import { Routes, Route} from "react-router-dom";
import Login from "./Pages/Login.jsx";
import SignUp from "./Pages/SignUp.jsx";

const AppRouter = () =>{
    return(
        <Routes>
            <Route path="/" element={<Login/> }/>
            <Route path="/SignUp" element={<SignUp/>}/>

        </Routes>
    )
}

export default AppRouter;