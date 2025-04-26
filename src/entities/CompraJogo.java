package entities;

public class CompraJogo {
	
	private int idCompra;
	private int idJogo;
	
	public CompraJogo(int idCompra, int idJogo) {
		super();
		this.idCompra = idCompra;
		this.idJogo = idJogo;
	}

	public int getIdCompra() {
		return idCompra;
	}

	public void setIdCompra(int idCompra) {
		this.idCompra = idCompra;
	}

	public int getIdJogo() {
		return idJogo;
	}

	public void setIdJogo(int idJogo) {
		this.idJogo = idJogo;
	}
	
}
