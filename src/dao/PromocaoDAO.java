package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import entities.Promocao;

public class PromocaoDAO {

    private Connection conn;

    public PromocaoDAO(Connection conn) {
        this.conn = conn;
    }

    public String criarPromocao(Promocao promocao) throws SQLException{
        String sql = "INSERT INTO promocao (nome, desconto, id_jogo, duracao) VALUES (?, ?, ?, ?)";
        PreparedStatement st = null;

        try {
            st = conn.prepareStatement(sql);
            st.setString(1, promocao.getNome());
            st.setDouble(2, promocao.getDesconto());
            st.setInt(3, promocao.getIdJogo());
            st.setTimestamp(4, promocao.getDuracao());

            st.executeUpdate();
            return "Promoção cadastrada com sucesso!";
        } catch (SQLException e) {
            e.printStackTrace();
            return "Erro ao cadastrar promoção: " + e.getMessage();
        } finally {
            BancoDados.finalizarStatement(st);
            BancoDados.desconectar();
        }
    }

    public String atualizarPromocao(Promocao promocao) throws SQLException{
        String sql = "UPDATE promocao SET nome = ?, desconto = ?, duracao = ? WHERE id_jogo = ?";
        PreparedStatement st = null;

        try {
            st = conn.prepareStatement(sql);
            st.setString(1, promocao.getNome());
            st.setDouble(2, promocao.getDesconto());
            st.setTimestamp(3, promocao.getDuracao());
            st.setInt(4, promocao.getIdJogo());

            int linhas = st.executeUpdate();
            if (linhas > 0) {
                return "Promoção atualizada com sucesso!";
            } else {
                return "Nenhuma promoção foi encontrada para atualizar.";
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return "Erro ao atualizar promoção: " + e.getMessage();
        } finally {
            BancoDados.finalizarStatement(st);
            BancoDados.desconectar();
        }
    }

    public String excluirPromocao(int idJogo) throws SQLException{
        String sql = "DELETE FROM promocao WHERE id_jogo = ?";
        PreparedStatement st = null;

        try {
            st = conn.prepareStatement(sql);
            st.setInt(1, idJogo);

            int linhas = st.executeUpdate();
            if (linhas > 0) {
                return "Promoção excluída com sucesso!";
            } else {
                return "Nenhuma promoção encontrada para esse jogo.";
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return "Erro ao excluir promoção: " + e.getMessage();
        } finally {
            BancoDados.finalizarStatement(st);
            BancoDados.desconectar();
        }
    }
}
