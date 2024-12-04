import React from "react";
import { Link } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPaperPlane } from "@fortawesome/free-solid-svg-icons";
import { faFacebookF, faInstagram, faLinkedin } from "@fortawesome/free-brands-svg-icons";

export function Footer() {
  return (
    <footer className="w-full h-[30vh]">
    
      <div className="flex justify-center items-center h-[40%] bg-[#2C3A57]"> 
        <form action="" method="POST" className="flex w-full justify-center items-center">
          <label htmlFor="email" className="text-white px-5 text-lg">Newsletter</label>
          <div className="flex items-center">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="your-email@site.com"
              required
              className="h-12 px-4 rounded-l-full bg-white text-gray-700 outline-none"
            />
            <button
              type="submit"
              className="h-12 w-12 flex items-center justify-center bg-[#3D71E7] rounded-r-full hover:bg-[#3B6CE3]"
            >
              <FontAwesomeIcon icon={faPaperPlane} style={{ color: "#FFD43B" }} />
            </button>
          </div>
        </form>
      </div>

   
      <div className="bg-[#3D71E7] h-[60%]">
        <div className="flex flex-col items-center justify-between h-full">
         
          <ul className="flex justify-center items-center text-white gap-12 h-1/2">
            <li>
              <Link to="/Home" className="hover:text-gray-300 text-lg">Accueil</Link>
            </li>
            <li>
              <Link to="/sellBook" className="hover:text-gray-300 text-lg">Demander un livre</Link>
            </li>
            <li>
              <Link to="/Shop" className="hover:text-gray-300 text-lg">Vendre un livre</Link>
            </li>
        
          </ul>


          <ul className="flex justify-center items-center text-white gap-8 h-1/2">
            <li>
              <a
                href="https://www.facebook.com/TeachrOfficial"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-gray-300"
              >
                <FontAwesomeIcon icon={faFacebookF} size="lg" />
              </a>
            </li>
            <li>
              <a
                href="https://www.instagram.com/teachrofficial/?hl=fr"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-gray-300"
              >
                <FontAwesomeIcon icon={faInstagram} size="lg" />
              </a>
            </li>
            <li>
              <a
                href="https://www.linkedin.com/company/teachrofficial/"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-gray-300"
              >
                <FontAwesomeIcon icon={faLinkedin} size="lg" />
              </a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
