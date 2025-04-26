package entities;

import java.time.LocalDate;

public class Admin extends Usuario {
	
	public LocalDate dataContratacao;
	
	public Admin(Integer id, String nome, String email, String senha, String tipoUsuario, String fotoPerfil, LocalDate dataContratacao) {
		super(id, nome, email, senha, "admin", fotoPerfil);
		this.dataContratacao = dataContratacao;
	}

	public Admin( String nome, String email, String senha, String tipoUsuario, String fotoPerfil, LocalDate dataContratacao) {
		super(nome, email, senha, "admin", fotoPerfil);
		this.dataContratacao = dataContratacao;
	}

	public LocalDate getDataContratacao() {
		return dataContratacao;
	}

	public void setDataContratacao(LocalDate dataContratacao) {
		this.dataContratacao = dataContratacao;
	}
}
