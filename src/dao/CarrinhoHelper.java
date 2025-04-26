package dao;

import java.util.ArrayList;
import java.util.List;

import entities.Jogo;

public class CarrinhoHelper {
    
	private List<Jogo> jogos = new ArrayList<>();

    public void adicionarJogo(Jogo jogo) {
        jogos.add(jogo);
    }

    public List<Jogo> getJogos() {
        return jogos;
    }

    public double calcularValorTotal() {
        return jogos.stream().mapToDouble(Jogo::getPreco).sum();
    }
}
