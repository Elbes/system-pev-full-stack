import { Link } from "react-router-dom";

export default function Sidebar() {
  const menus = JSON.parse(localStorage.getItem("menus") || "[]");

  return (
    <div className="sidebar">
      <h2>SLU</h2>

      {menus.map(menu => (
        <div key={menu.id_menu}>
          <Link to={menu.url || "/"}>{menu.nom_menu}</Link>

          {menu.get_sub_menu && menu.get_sub_menu.map(sub => (
            <Link
              key={sub.id_menu}
              to={sub.url}
              style={{ paddingLeft: 30 }}
            >
              {sub.nom_menu}
            </Link>
          ))}
        </div>
      ))}
    </div>
  );
}
