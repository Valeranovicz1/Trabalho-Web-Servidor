package entities;


public class Jogo {
	
	private int idJogo;
	private String nome;
	private String descricao;
	private CategoriaEnum categoria;
	private String imagem;
	private Double preco;
	private int classificacao;
	private int idEmpresa;

	
	public Jogo(int id, String nome, String descricao,String Categoria, String imagem,Double preco,int idEmpresa,CategoriaEnum categoria, int classificacao) {
	
		this.idJogo = id;
		this.nome = nome;
		this.descricao = descricao;
		this.categoria = categoria;
		this.imagem = imagem;
		this.idEmpresa = idEmpresa;
		this.preco = preco;
		this.classificacao = classificacao;
	}
	
	public Jogo(String nome, String descricao,String Categoria, String imagem,Double preco,int idEmpresa, CategoriaEnum categoria,int classificacao) {

		this.nome = nome;
		this.descricao = descricao;
		this.categoria = categoria;
		this.imagem = imagem;
		this.idEmpresa = idEmpresa;
		this.preco = preco;
		this.classificacao = classificacao;
	}
	
	public Jogo() {
		
	}
	
	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public String getDescricao() {
		return descricao;
	}

	public void setDescricao(String descricao) {
		this.descricao = descricao;
	}

	public String getImagem() {
        return imagem;
    }

    public void setImagem(String imagem) {
        this.imagem = imagem;
    }

	public int getIdEmpresa() {
		return idEmpresa;
	}

	public void setIdEmpresa(int idEmpresa) {
		this.idEmpresa = idEmpresa;
	}


	public Double getPreco() {
		return preco;
	}

	public void setPreco(Double preco) {
		this.preco = preco;
	}

	public int getIdJogo() {
		return idJogo;
	}

	public void setIdJogo(int idJogo) {
		this.idJogo = idJogo;
	}


	public int getClassificacao() {
		return classificacao;
	}

	public void setClassificacao(int classificacao) {
		this.classificacao = classificacao;
	}

	public CategoriaEnum getCategoria() {
		return categoria;
	}

	public void setCategoria(CategoriaEnum categoria) {
		this.categoria = categoria;
	}

}
