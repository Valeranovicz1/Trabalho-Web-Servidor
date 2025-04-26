package entities;

import java.time.LocalDate;

public class Cliente extends Usuario{
	
	private String nickname;
	private Double valorCarteira;
	private LocalDate dataNascimento;
	
	public Cliente(Integer id, String nome,String nickname, String email, String senha, String fotoPerfil, LocalDate dataNascimento) {
		super(id, nome, email, senha, "cliente", fotoPerfil);
		this.nickname = nickname;
		this.valorCarteira = 0.0;
		this.dataNascimento = dataNascimento;

	}
	
	public Cliente(String nome,String nickname, String email, String senha, String fotoPerfil, LocalDate dataNascimento) {
		super(nome, email, senha, "cliente", fotoPerfil);
		this.nickname = nickname;
		this.valorCarteira = 0.0;
		this.dataNascimento = dataNascimento;
	}

	public Double getValorCarteira() {
		return valorCarteira;
	}

	public void setValorCarteira(Double valorCarteira) {
		this.valorCarteira = valorCarteira;
	}

	public LocalDate getDataNascimento() {
		return dataNascimento;
	}

	public void setDataNascimento(LocalDate dataNascimento) {
		this.dataNascimento = dataNascimento;
	}

	public String getNickname() {
		return nickname;
	}

	public void setNickname(String nickname) {
		this.nickname = nickname;
	}

}
