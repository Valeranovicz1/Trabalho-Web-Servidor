package entities;


public class Usuario {
	
	private String nome, email, senha, tipoUsuario;
	private String fotoPerfil;
	private Integer id;
	
	public Usuario(Integer id, String nome, String email, String senha, String tipoUsuario, String fotoPerfil) {
		this.id = id;
		this.nome = nome;
		this.email = email;
		this.senha = senha;
		this.fotoPerfil = fotoPerfil;
	}
	
	public Usuario(String nome, String email, String senha, String tipoUsuario, String fotoPerfil) {
		this.nome = nome;
		this.email = email;
		this.senha = senha;
		this.fotoPerfil = fotoPerfil;
	}
	
	public Usuario() {
		
	}

	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getSenha() {
		return senha;
	}

	public void setSenha(String senha) {
		this.senha = senha;
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}
	
	public String getTipoUsuario() {
		return this.tipoUsuario;
	}
	
	public void setTipoUsuario(String tipoUsuario) {
		this.tipoUsuario = tipoUsuario;
	}

	public String getFotoPerfil() {
		return fotoPerfil;
	}

	public void setFotoPerfil(String fotoPerfil) {
		this.fotoPerfil = fotoPerfil;
	}
	
	
}
