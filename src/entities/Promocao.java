package entities;

import java.sql.Timestamp;


public class Promocao {
	
	private int idPromocao;
	private String nome;
	private Double desconto;
	private int idJogo;
	private Timestamp duracao;
	
	public Promocao(int idPromocao, String nome, Double desconto, int idJogo, Timestamp duracao) {
		
		this.idPromocao = idPromocao;
		this.nome = nome;
		this.desconto = desconto;
		this.idJogo = idJogo;
		this.duracao = duracao;
	}
	
	public Promocao(String nome, Double desconto,int idJogo, Timestamp duracao) {
		
		this.nome = nome;
		this.desconto = desconto;
		this.idJogo = idJogo;
		this.duracao = duracao;
	}
	
	public Promocao() {
		
	}
	
	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public Double getDesconto() {
		return desconto;
	}

	public void setDesconto(Double desconto) {
		this.desconto = desconto;
	}

	public int getIdPromocao() {
		return idPromocao;
	}

	public void setIdPromocao(int idPromocao) {
		this.idPromocao = idPromocao;
	}


	public Timestamp getDuracao() {
		return duracao;
	}

	public void setDuracao(Timestamp duracao) {
		this.duracao = duracao;
	}

	public int getIdJogo() {
		return idJogo;
	}

	public void setIdJogo(int idJogo) {
		this.idJogo = idJogo;
	}

	
}
