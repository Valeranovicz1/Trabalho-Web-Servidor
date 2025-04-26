package entities;

public enum CategoriaEnum {
	
	 ACAO ("Acão"),
	 AVENTURA ("Aventura"),
	 RPG ("RPG"),
	 ESTRATEGIA ("Estratégia"),
	 CORRIDA ("Corrida"),
	 SIMULACAO ("Simulação"),
	 TERROR ("Terror"),
	 PUZZLE ("Puzzle"),
	 MULTIPLAYER ("Multiplayer"),
	 INDIE ("Indie");
	
	private String descricao;
		
	private CategoriaEnum(String descricao) {
		this.descricao = descricao;
	}
		
	public String getDescricao() {
		return this.descricao;
	}
		
	   public static CategoriaEnum fromString(String value) {
		   for (CategoriaEnum status : CategoriaEnum.values()) {
			   if (status.getDescricao().equalsIgnoreCase(value)) {
				   return status;
	            }
	        }
	        throw new IllegalArgumentException("Categoria do jogo inválida: " + value);
	    }
}

