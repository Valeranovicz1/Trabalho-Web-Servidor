package entities;

import java.time.LocalDate;
import java.util.List;

public class Compra {
	
	public int idJogo;
	public int idCliente;
	public LocalDate dataCompra;
	public List<Jogo> carrinho;
	public Double valorTotal;
	
	public Compra(int idJogo, int idCliente, LocalDate dataCompra, List<Jogo> carrinho, Double valorTotal) {
		
		this.idJogo = idJogo;
		this.idCliente = idCliente;
		this.dataCompra = dataCompra;
		this.carrinho = carrinho;
		this.valorTotal = valorTotal;
	}
	
	public Compra(int idCliente, LocalDate dataCompra, List<Jogo> carrinho, Double valorTotal) {
		
		this.idCliente = idCliente;
		this.dataCompra = dataCompra;
		this.carrinho = carrinho;
		this.valorTotal = valorTotal;
	}
	
	public Compra() {
		
	}
	
	public int getIdJogo() {
		return idJogo;
	}

	public void setIdJogo(int idJogo) {
		this.idJogo = idJogo;
	}

	public int getIdCliente() {
		return idCliente;
	}

	public void setIdCliente(int idCliente) {
		this.idCliente = idCliente;
	}

	public LocalDate getDataCompra() {
		return dataCompra;
	}

	public void setDataCompra(LocalDate dataCompra) {
		this.dataCompra = dataCompra;
	}

	public List<Jogo> getCarrinho() {
		return carrinho;
	}

	public void setCarrinho(List<Jogo> carrinho) {
		this.carrinho = carrinho;
	}

	public Double getValorTotal() {
		return valorTotal;
	}

	public void setValorTotal(Double valorTotal) {
		this.valorTotal = valorTotal;
	}
	
	
}
