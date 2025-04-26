package entities;

import java.time.LocalDate;

public class ListaDesejos {
	
	private int idCliente, idJogo;
	private LocalDate dataAdicionado;
	
	public ListaDesejos(int idCliente, int idJogo, LocalDate dataAdicionado) {
		super();
		this.idCliente = idCliente;
		this.idJogo = idJogo;
		this.dataAdicionado = dataAdicionado;
	}

	public int getIdCliente() {
		return idCliente;
	}

	public void setIdCliente(int idCliente) {
		this.idCliente = idCliente;
	}

	public int getIdJogo() {
		return idJogo;
	}

	public void setIdJogo(int idJogo) {
		this.idJogo = idJogo;
	}

	public LocalDate getDataAdicionado() {
		return dataAdicionado;
	}

	public void setDataAdicionado(LocalDate dataAdicionado) {
		this.dataAdicionado = dataAdicionado;
	}
	
}
