export default function Header() {
  const user = JSON.parse(localStorage.getItem("user"));

  return (
    <div className="header">
      <div>Sistema PEV</div>
      <div>
        Usuário: <b>{user?.nom_usuario}</b>
      </div>
    </div>
  );
}
