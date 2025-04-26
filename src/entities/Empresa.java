package entities;


public class Empresa extends Usuario{
	
	private String site;
	
	public Empresa(Integer id, String nome, String email, String senha, String fotoPerfil, String site) {
		super(id, nome, email, senha, "empresa", fotoPerfil);
		this.site = site;
	}
	
	public Empresa(String nome, String email, String senha, String fotoPerfil, String site) {
		super(nome, email, senha, "empresa", fotoPerfil);
		this.site = site;
	}
	
	public String getSite() {
		return site;
	}

	public void setSite(String site) {
		this.site = site;
	}
	
	
	
}
