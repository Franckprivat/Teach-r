import React, { useEffect, useState } from "react";
import Header from "../Components/Header.jsx";
import Footer from "../Components/Footer.jsx";
 
const Shop = () => {
    const [products, setProducts] = useState([]);
    const [categories, setCategories] = useState([]);

    return (
    <div>
        <Header/>
        <div className="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg">
            <h1 className="text-4xl font-bold text-[#0056b3] mb-6 text-center">
                Liste des Produits
            </h1>
            <table className="min-w-full table-auto border-collapse border border-gray-200 rounded-lg">
                <thead>
                    <tr className="bg-[#0056b3] text-white">
                        <th className="border px-4 py-3 text-left">Nom</th>
                        <th className="border px-4 py-3 text-left">Description</th>
                        <th className="border px-4 py-3 text-left">Prix</th>
                        <th className="border px-4 py-3 text-left">Catégorie</th>
                    </tr>
                </thead>
                <tbody>
                    {products.length > 0 ? (
                        products.map((product) => (
                            <tr
                                key={product.id}
                                className="hover:bg-blue-50 transition duration-200"
                            >
                                <td className="border px-4 py-3 text-gray-700">
                                    {product.name}
                                </td>
                                <td className="border px-4 py-3 text-gray-600">
                                    {product.description}
                                </td>
                                <td className="border px-4 py-3 text-gray-700 font-semibold">
                                    {product.price} €
                                </td>
                                <td className="border px-4 py-3 text-gray-700">
                                    {categories.find(
                                        (category) => category.id === product.category_id
                                    )?.name || "Inconnu"}
                                </td>
                            </tr>
                        ))
                    ) : (
                        <tr>
                            <td
                                colSpan="4"
                                className="text-center py-4 text-gray-500 font-medium"
                            >
                                Aucun produit disponible
                            </td>
                        </tr>
                    )}
                </tbody>
            </table>
        </div>
        <Footer/>
        </div>
    );
};
 
export default Shop;